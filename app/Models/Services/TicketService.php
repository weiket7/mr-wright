<?php

namespace App\Models\Services;

use App\Mail\QuotationMail;
use App\Models\CategoryForTicket;
use App\Models\Company;
use App\Models\Enums\TicketStat;
use App\Models\Helpers\BackendHelper;
use App\Models\Office;
use App\Models\Requester;
use App\Models\Setting;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Log;
use Mail;
use Validator;

class TicketService
{
  protected $validation;

  public function __construct(WorkingHourService $working_hour_service)
  {
    $this->working_hour_service = $working_hour_service;
  }

  public function getTicket($ticket_id) {
    $ticket = Ticket::findOrNew($ticket_id);
    $ticket->issues = DB::table('ticket_issue')->where('ticket_id', $ticket_id)->orderBy('ticket_issue_id')->get();
    $ticket->staff_assignments = $this->getStaffAssignments($ticket_id);
    $ticket->skills = $this->getTicketSkills($ticket_id);
    $ticket->preferred_slots = $this->getPreferredSlots($ticket_id);
    return $ticket;
  }

  public function getPreferredSlots($ticket_id) {
    $data = DB::table('ticket_preferred_slot')->where('ticket_id', $ticket_id)
      ->select('ticket_preferred_slot_id', 'date',
        DB::raw("lower(time_format(time_start, '%l:%i %p')) as time_start"),
        DB::raw("lower(time_format(time_end, '%l:%i %p')) as time_end"))->get();
    return $data;
  }

  public function populateTicketForView($ticket) {
    $ticket->company = Company::where('company_id', $ticket->company_id)->first();
    $ticket->office = Office::find($ticket->office_id);
    $ticket->requester = Requester::where('username', $ticket->requested_by)->first();
    $ticket->category = CategoryForTicket::where('category_for_ticket_id', $ticket->category_id)->first();
    $data = DB::table('staff_assignment as sa')
      ->join('staff as s', 'sa.staff_id', '=', 's.staff_id')
      ->where('ticket_id', $ticket->ticket_id)
      ->select('s.name', 'date', 'time_start', 'time_end')
      ->get();
    $res = [];
    foreach($data as $d) {
      $res[$d->date][] = $d;
    }
    $ticket->staff_assignments = $res;
    $ticket->skills = DB::table('ticket_skill as ts')
      ->join('skill as s', 'ts.skill_id', '=', 's.skill_id')
      ->where('ticket_id', $ticket->ticket_id)->pluck('s.name');
    return $ticket;
  }

  private function getStaffAssignments($ticket_id) {
    $data = DB::table('staff_assignment')->where('ticket_id', $ticket_id)->get();
    $res = [];
    foreach($data as $d) {
      $intervals = $this->working_hour_service->splitTimeRangeIntoInterval($d->time_start, $d->time_end);
      if (isset($res[$d->staff_id][$d->date])) {
        foreach($intervals as $i) {
          array_push($res[$d->staff_id][$d->date], $i);
        }
      } else {
        $res[$d->staff_id][$d->date] = $intervals;
      }
    }
    return (object)$res;
  }

  private function getTicketSkills($ticket_id) {
    $data = DB::table('ticket_skill')->where('ticket_id', $ticket_id)->pluck('skill_id');
    $res = [];
    foreach($data as $d) {
      $res[] = $d;
    }
    return $res;
  }

  public function getCategoryDropdown() {
    return CategoryForTicket::pluck('name', 'category_for_ticket_id');
  }

  public function getSkills() {
    return DB::table('skill')->pluck('name', 'skill_id');
  }

  private $rules = [
    'title'=>'required',
    'company_id'=>'required',
    'office_id'=>'required',
    'requested_by'=>'required',
    'category_id'=>'required',
    'requested_on'=>'required',
  ];

  private $messages = [
    'title.required'=>'Title is required',
    'company_id.required'=>'Company is required',
    'office_id.required'=>'Office is required',
    'requested_by.required'=>'Requested By is required',
    'category_id.required'=>'Category is required',
    'requested_on.required'=>'Requested On is required',
  ];

  public function saveTicket($ticket_id, $input, $operator = 'admin') {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }

    $ticket = Ticket::findOrNew($ticket_id);
    $ticket->title = $input['title'];
    $ticket->category_id = $input['category_id'];
    $ticket->urgency = $input['urgency'];
    $ticket->company_id = $input['company_id'];
    $ticket->company_name = Company::find($input['company_id'])->value('name');
    $ticket->office_id = $input['office_id'];
    $ticket->requester_desc = $input['requester_desc'];
    $ticket->operator_desc = $input['operator_desc'];
    $ticket->quoted_price = $input['quoted_price'];
    $ticket->quotation_desc = $input['quotation_desc'];
    $ticket->requested_by = $input['requested_by'];
    $ticket->updated_on = Carbon::now();

    $ticket->requested_on = Carbon::createFromFormat('d M Y', $input['requested_on']);
    if ($ticket_id == null) {
      $ticket->ticket_code = $this->getNextTicketCode($ticket->company_id);
      $ticket->stat = TicketStat::Drafted;
      $ticket->drafted_by = $operator;
      $ticket->drafted_on = Carbon::now();
    }
    $ticket->recent_action = $ticket_id == null ? 'draft' : 'update';
    $ticket->save();

    $this->saveStaffAssignments($ticket->ticket_id, $input);
    $this->saveTicketIssues($ticket->ticket_id, $input);
    $this->savePreferredSlots($ticket->ticket_id, $input);

    return $ticket->ticket_id;
  }

  public function getNextTicketCode($company_id) {
    $start_of_month = Carbon::now()->startOfMonth();
    $start_of_next_month = Carbon::now()->startOfMonth()->addMonth(1);

    $latest_ticket_code = DB::table('ticket')
      ->where('company_id', $company_id)
      ->where('opened_on', '>=', $start_of_month)
      ->where('opened_on', '<', $start_of_next_month)
      ->value('ticket_code');

    if ($latest_ticket_code == null) {
      $company_code = Company::find($company_id)->value ('code');
      $month_year = $start_of_month->format('m').$start_of_month->format('y');
      return $company_code.'_'.$month_year.'_001';
    }

    $arr = explode('_' , $latest_ticket_code);
    $number = $arr[2];
    return $arr[0].'_'.$arr[1].'_'.str_pad($number+1, 3, '0', STR_PAD_LEFT);
  }

  public function sendQuotation($ticket_id, $operator = 'admin')
  {
    $ticket = Ticket::findOrFail($ticket_id);
    $ticket->stat = TicketStat::Quoted;
    $ticket->quoted_by = $operator;
    $ticket->quoted_on = Carbon::now();
    $ticket->recent_action = 'quote';
    $quote_valid_working_days = Setting::getSetting('quote_valid_working_days');
    $ticket->quote_valid_till = Carbon::now()->addWeekday($quote_valid_working_days);
    $ticket->save();

    $ticket = $this->getTicket($ticket_id);
    $this->populateTicketForView($ticket);
    Mail::to($user = Requester::where('username', $ticket->requested_by)->first())->send(new QuotationMail($ticket));
    return true;
  }

  public function openTicket($ticket_id, $operator = 'admin')
  {
    $ticket = Ticket::findOrFail($ticket_id);
    $ticket->stat = TicketStat::Opened;
    $ticket->opened_by = $operator;
    $ticket->opened_on = Carbon::now();
    $ticket->updated_on = Carbon::now();
    $ticket->recent_action = 'open';
    return $ticket->save();
  }

  public function acceptTicket($ticket_id, $operator = 'admin') {
    $ticket = Ticket::findOrFail($ticket_id);
    $ticket->stat = TicketStat::Accepted;
    //$ticket->agreed_price = $ticket->quoted_price; //TODO
    $ticket->accepted_by = $operator;
    $ticket->accepted_on = Carbon::now();
    $ticket->updated_on = Carbon::now();
    $ticket->recent_action = 'accept';
    return $ticket->save();
  }

  public function declineTicket($ticket_id, $input, $operator = 'admin') {
    $ticket = Ticket::findOrFail($ticket_id);
    $ticket->stat = TicketStat::Declined;
    $ticket->decline_reason = $input['decline_reason'];
    $ticket->declined_by = $operator;
    $ticket->declined_on = Carbon::now();
    $ticket->updated_on = Carbon::now();
    $ticket->recent_action = 'decline';
    return $ticket->save();
  }

  public function completeTicket($ticket_id, $operator = 'admin')
  {
    $ticket = Ticket::findOrFail($ticket_id);
    $ticket->stat = TicketStat::Completed;
    $ticket->completed_by = $operator;
    $ticket->completed_on = Carbon::now();
    $ticket->updated_on = Carbon::now();
    $ticket->recent_action = 'complete';
    return $ticket->save();
  }

  public function populateCompanyOfficeRequester($ticket) {

  }

  public function saveTicketIssues($ticket_id, $input) {
    $issues_count = $input['issues_count'];
    for($i=0; $i<$issues_count; $i++) {
      if (isset($input['issue_stat'.$i]) && $input['issue_stat'.$i] == 'delete') {
        DB::table('ticket_issue')->where('ticket_issue_id', $input['issue_id'.$i])->delete();
        continue;
      }

      $ticket_issue = [
        'issue_desc' => $input['issue'.$i],
        'expected_desc' => $input['expected'.$i],
      ];
      if (isset($input['issue_stat'.$i]) && $input['issue_stat'.$i] == 'add') {
        $ticket_issue['ticket_id'] = $ticket_id;
        $ticket_issue_id = DB::table('ticket_issue')->insertGetId($ticket_issue);
      } else {
        $ticket_issue_id = $input['issue_id'.$i];
        DB::table('ticket_issue')->where('ticket_issue_id', $ticket_issue_id)->update($ticket_issue);
      }

      $image = isset($input['image' . $i]) ? $input['image' . $i] : null;
      if ($image) {
        $image_name = BackendHelper::uploadFile('images/tickets', $ticket_id.'_'.$ticket_issue_id, $image);
        DB::table('ticket_issue')->where('ticket_issue_id', $ticket_issue_id)->update(['image'=>$image_name]);
      }
    }

  }

  public function saveStaffAssignments($ticket_id, $input) {
    DB::table('staff_assignment')->where('ticket_id', $ticket_id)->delete();

    $staff_assignments = json_decode($input['staff_assignments'], true);
    foreach($staff_assignments as $staff_id => $date_assignments) {
      foreach($date_assignments as $date => $assignments) {
        $periods = $this->working_hour_service->mergeIntervalsIntoTimeRange($assignments);
        foreach($periods as $p) {
          $staff_assignment = [
            'ticket_id'=>$ticket_id,
            'date'=>$date,
            'staff_id'=>$staff_id,
            'time_start'=>$p['time_start'],
            'time_end'=>$p['time_end'],
          ];
          DB::table('staff_assignment')->insert($staff_assignment);
        }
      }
    }
  }

  private function savePreferredSlots($ticket_id, $input, $operator = 'admin')
  {
    $preferred_slots_count = $input['preferred_slots_count'];
    for($i=0; $i<$preferred_slots_count; $i++) {
      if (isset($input['preferred_slot_stat'.$i]) && $input['preferred_slot_stat'.$i] == 'delete') {
        DB::table('ticket_preferred_slot')->where('ticket_preferred_slot_id', $input['preferred_slot_id'.$i])->delete();
        continue;
      }

      $preferred_slot = [
        'date' => Carbon::createFromFormat('d M Y', $input['preferred_slot_date'.$i]),
        'time_start' => $input['preferred_slot_time_start'.$i],
        'time_end' => $input['preferred_slot_time_end'.$i],
        'updated_by'=>$operator,
        'updated_on'=>Carbon::now()
      ];
      if (isset($input['preferred_slot_stat'.$i]) && $input['preferred_slot_stat'.$i] == 'add') {
        $preferred_slot['ticket_id'] = $ticket_id;
        DB::table('ticket_preferred_slot')->insert($preferred_slot);
      } else {
        $preferred_slot_id = $input['preferred_slot_id'.$i];
        DB::table('ticket_preferred_slot')->where('ticket_preferred_slot_id', $preferred_slot_id)->update($preferred_slot);
      }
    }
  }

  public function getValidation() {
    return $this->validation;
  }

  public function searchTicket($input) {
    $s = "SELECT stat, ticket_code, ticket_id, title, category_id, quoted_price, requested_by, requested_on 
    from ticket
    where 1 ";
    if (isset($input['stat'])) {
      if (is_array($input['stat']) && count($input['stat'])) {
        $s .= " and stat in ('".implode(',', $input['stat'])."')";
      } elseif ($input['stat'] != '') {
        $s .= " and stat = '".$input['stat']."'";
      }
    }

    if (isset($input['title']) && $input['title'] != '') {
      $s .= " and title like '%".$input['title']."%'";
    }
    if (isset($input['ticket_code']) && $input['ticket_code'] != '') {
      $s .= " and ticket_code = '".$input['ticket_code']."'";
    }

    if (isset($input['quoted_price_from']) && isset($input['quoted_price_to'])
      && $input['quoted_price_from'] != '' && $input['quoted_price_to'] != '') {
      $quoted_price_from = $input['quoted_price_from'];
      $quoted_price_to = $input['quoted_price_to'];
      $s .= " and (quoted_price >= '".$quoted_price_from."' and quoted_price <= '".$quoted_price_to."')";
    }

    if (isset($input['date_column']) && $input['date_column'] != '') {
      if (isset($input['date_from']) && isset($input['date_to'])
        && $input['date_from'] != '' && $input['date_to'] != '') {
        $date_column = $input['date_column'];
        $date_from = Carbon::createFromFormat('d M y', $input['date_from']);
        $date_to = Carbon::createFromFormat('d M y', $input['date_to'])->addDay(1)->format('Y-m-d');
        $s .= " and (".$date_column." >= '".$date_from."' and ".$date_column." < '".$date_to."')";
      }
    }

    if (isset($input['company_id']) && $input['company_id'] != '') {
      $s .= " and company_id = '".$input['company_id']."'";
    }
    if (isset($input['office_id']) && $input['office_id'] != '') {
      $s .= " and office_id = '".$input['office_id']."'";
    }
    if (isset($input['requested_by']) && $input['requested_by'] != '') {
      $s .= " and requested_by = '".$input['requested_by']."'";
    }
    Log::info($s);
    return DB::select($s);
  }

  
}