<?php

namespace App\Models\Services;

use App\Mail\InvoiceMail;
use App\Mail\QuotationMail;
use App\Mail\TicketAcceptMail;
use App\Models\CategoryForTicket;
use App\Models\Company;
use App\Models\Enums\StaffAssignmentStat;
use App\Models\Enums\TicketStat;
use App\Models\Helpers\BackendHelper;
use App\Models\Office;
use App\Models\Requester;
use App\Models\Setting;
use App\Models\Staff;
use App\Models\Ticket;
use App\Models\TicketHistory;
use App\Models\TicketOtp;
use Carbon\Carbon;
use DB;
use Mail;
use Validator;

class TicketService
{
  protected $validation;

  public function getTicket($ticket_id) {
    $ticket = Ticket::findOrNew($ticket_id);
    $ticket->issues = $this->getTicketIssues($ticket_id);
    $ticket->staff_assignments = $this->getStaffAssignments($ticket_id);
    $ticket->skills = $this->getTicketSkills($ticket_id);
    $ticket->history = $this->getTicketHistory($ticket_id);
    $ticket->preferred_slots = $this->getPreferredSlots($ticket_id);
    $ticket->otps = $this->getOtps($ticket_id);
    return $ticket;
  }

  public function getTicketIssues($ticket_id) {
    return DB::table('ticket_issue')->where('ticket_id', $ticket_id)->orderBy('ticket_issue_id')->get();
  }

  public function populateTicketForView($ticket) {
    $data = DB::table('staff_assignment as sa')
      ->where('ticket_id', $ticket->ticket_id)
      ->select('staff_name', 'date', 'staff_mobile', 'time_start', 'time_end')
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

  public function getOtps($ticket_id) {
    return DB::table('ticket_otp')->where('ticket_id', $ticket_id)->get();
  }

  public function getPreferredSlots($ticket_id) {
    $data = DB::table('ticket_preferred_slot')->where('ticket_id', $ticket_id)
      ->select('ticket_preferred_slot_id', 'date',
        DB::raw("lower(time_format(time_start, '%H:%i')) as time_start"),
        DB::raw("lower(time_format(time_end, '%H:%i')) as time_end"))->orderBy('date')->get();
    return $data;
  }

  public function getStaffAssignments($ticket_id) {
    $data = DB::table('staff_assignment')->where('ticket_id', $ticket_id)->get();
    $res = [];
    foreach($data as $d) {
      $working_hour_service = new WorkingHourService();
      $intervals = $working_hour_service->splitTimeRangeIntoInterval($d->time_start, $d->time_end);
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

  private $rules = [
    'title'=>'required',
    'category_id'=>'required',
    'company_id'=>'sometimes|required',
    'office_id'=>'sometimes|required',
    'requested_by'=>'sometimes|required',
    'requested_on'=>'sometimes|required',
  ];

  private $messages = [
    'title.required'=>'Title is required',
    'category_id.required'=>'Category is required',
    'company_id.required'=>'Company is required',
    'office_id.required'=>'Office is required',
    'requested_by.required'=>'Requested By is required',
    'requested_on.required'=>'Requested On is required',
  ];

  public function saveTicket($ticket_id, $input, $username = 'admin') {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }
    if ($this->validateTicketIssues($input) === false) {
      $this->validation->errors()->add("image", "Images must be png, jpg or gif<br>Videos must be wmv, mov, mp4, flv or avi");
      return false;
    }

    $ticket = Ticket::findOrNew($ticket_id);
    $ticket->title = $input['title'];
    $ticket->category_id = $input['category_id'];
    $ticket->category_name = CategoryForTicket::find($input['category_id'])->value('name');
    $ticket->urgency = $input['urgency'];
    $ticket->company_id = $input['company_id'];
    $ticket->company_name = Company::find($input['company_id'])->value('name');
    $ticket->office_id = $input['office_id'];
    $office = Office::find($input['office_id']);
    $ticket->office_addr = $office->addr;
    $ticket->office_postal = $office->postal;
    $ticket->requester_desc = $input['requester_desc'];
    $ticket->operator_desc = $input['operator_desc'];
    $ticket->quoted_price = $input['quoted_price'];
    $ticket->quotation_desc = $input['quotation_desc'];
    $ticket->requested_by = $input['requested_by'];
    $ticket->requested_on = Carbon::createFromFormat('d M Y', $input['requested_on']);

    if ($ticket_id == null) {
      $ticket->ticket_code = $this->getNextTicketCode($ticket->company_id);
      $ticket->stat = TicketStat::Drafted;
    }
    $ticket->save();
  
    $this->saveTicketIssues($ticket->ticket_id, $input);
    $this->saveStaffAssignments($ticket->ticket_id, $ticket->ticket_code, $input);
    $this->savePreferredSlots($ticket->ticket_id, $input);
    $this->saveTicketSkills($ticket->ticket_id, $input);

    return $ticket->ticket_id;
  }

  public function saveFrontendTicket($ticket_id, $input, $username = 'admin') {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }

    $ticket = Ticket::findOrNew($ticket_id);
    $ticket->title = $input['title'];
    $ticket->category_id = $input['category_id'];
    $ticket->category_name = CategoryForTicket::find($input['category_id'])->value('name');
    $ticket->urgency = $input['urgency'];
    $ticket->requester_desc = $input['requester_desc'];

    $requester_service = new Requester();
    $requester = $requester_service->getRequesterByUsername($username);
    $ticket->office_id = $requester->office_id;
    $ticket->company_id = $requester->company_id;
    $ticket->company_name = $requester->company_name;
    $office = Office::find($ticket->office_id);
    $ticket->office_addr = $office->addr;
    $ticket->office_postal = $office->postal;

    $ticket->requested_by = $username;
    $ticket->requested_on = Carbon::now();

    if ($ticket_id == null) {
      $ticket->ticket_code = $this->getNextTicketCode($ticket->company_id);
      $ticket->stat = TicketStat::Drafted;
    }
    $ticket->save();

    $this->saveTicketIssues($ticket->ticket_id, $input);
    $this->savePreferredSlots($ticket->ticket_id, $input);

    return $ticket->ticket_id;
  }

  public function getNextTicketCode($company_id) {
    $start_of_month = Carbon::now()->startOfMonth();
    $start_of_next_month = Carbon::now()->startOfMonth()->addMonth(1);
    $latest_ticket_code = DB::table('ticket')
      ->where('company_id', $company_id)
      ->where('requested_on', '>=', $start_of_month)
      ->where('requested_on', '<', $start_of_next_month)
      ->orderBy('requested_on', 'desc')
      ->value('ticket_code');
    //Log::info('getNextTicketCode - company_id='.$company_id.' latest_ticket_code='.$latest_ticket_code.' start_of_mth='.$start_of_month.' start_of_next_mth='.$start_of_next_month);
  
    if ($latest_ticket_code == null) {
      $company= Company::find($company_id);
      $month_year = $start_of_month->format('m').$start_of_month->format('y');
      return $company->code.'_'.$month_year.'_001';
    }

    $arr = explode('_' , $latest_ticket_code);
    $number = $arr[2];
    return $arr[0].'_'.$arr[1].'_'.str_pad($number+1, 3, '0', STR_PAD_LEFT);
  }

  public function sendQuotation($ticket_id, $username = 'admin')
  {
    $ticket = Ticket::findOrFail($ticket_id);
    $ticket->stat = TicketStat::Quoted;
    $quote_valid_days = Setting::getSetting('quote_valid_days');
    $ticket->quote_valid_till = Carbon::now()->addWeekday($quote_valid_days);
    $ticket->save();

    $this->saveTicketHistory($ticket_id, 'quote', $username);

    return $ticket;
  }

  public function openTicket($ticket_id, $username = 'admin') {
    $ticket = Ticket::findOrFail($ticket_id);
    $ticket->stat = TicketStat::Opened;
    $ticket->save();

    $this->saveTicketHistory($ticket_id, 'open', $username);
    return true;
  }

  public function acceptTicket($ticket_id, $input, $username = 'admin') {
    $ticket = Ticket::findOrFail($ticket_id);
    $ticket->stat = TicketStat::Accepted;
    $ticket->accept_decline_reason = $input['accept_decline_reason'];
    $ticket->save();

    DB::table('staff_assignment')->where('ticket_id', $ticket_id)->update(['stat'=>StaffAssignmentStat::Pending]);
    
    $dates = DB::table('staff_assignment')->where('ticket_id', $ticket_id)->distinct()->pluck('date');
    foreach($dates as $d) {
      $this->generateTicketOtp($ticket_id, $d);
    }

    $this->saveTicketHistory($ticket_id, 'accept', $username);
    return $ticket;
  }
  
  private function generateTicketOtp($ticket_id, $date) {
    $ticket_otp = new TicketOtp();
    $ticket_otp->ticket_id = $ticket_id;
    $ticket_otp->date = $date;
    $ticket_otp->first_otp = rand(000000, 999999);
    $ticket_otp->second_otp = rand(000000, 999999);
    $ticket_otp->date_time_start =
    $ticket_otp->save();
  }

  public function declineTicket($ticket_id, $input, $username = 'admin') {
    $ticket = Ticket::findOrFail($ticket_id);
    $ticket->stat = TicketStat::Declined;
    $ticket->accept_decline_reason = $input['accept_decline_reason'];
    $ticket->save();

    $this->saveTicketHistory($ticket_id, 'decline', $username);
    DB::table('staff_assignments')->where('ticket_id', $ticket_id)->delete();
    return true;
  }

  public function completeTicket($ticket_id, $username = 'admin') {
    $ticket = Ticket::findOrFail($ticket_id);
    $ticket->stat = TicketStat::Completed;
    $ticket->save();

    $this->saveTicketHistory($ticket_id, 'complete', $username);
    return true;
  }
  
  public function validateTicketIssues($input) {
    $issues_count = $input['issues_count'];
  
    for($i=0; $i<$issues_count; $i++) {
      $image = isset($input['image' . $i]) ? $input['image' . $i] : null;
      if ($image) {
        if (in_array(strtolower($image->getClientOriginalExtension()), ['png', 'jpg', 'gif' ,'wmv', 'avi', 'flv', 'mp4', 'mov']) === false) {
          return false;
        }
      }
    }
    return true;
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
    return true;
  }

  public function saveStaffAssignments($ticket_id, $ticket_code, $input) {
    DB::table('staff_assignment')->where('ticket_id', $ticket_id)->delete();

    $staff_assignments = json_decode($input['staff_assignments'], true);
    foreach($staff_assignments as $staff_id => $date_assignments) {
      $staff = Staff::find($staff_id);
      foreach($date_assignments as $date => $assignments) {
        $working_hour_service = new WorkingHourService();
        $periods = $working_hour_service->mergeIntervalsIntoTimeRange($assignments);
        foreach($periods as $p) {
          $staff_assignment = [
            'ticket_id'=>$ticket_id,
            'ticket_code'=>$ticket_code,
            'date'=>$date,
            'staff_id'=>$staff_id,
            'staff_username'=>$staff->username,
            'staff_name'=>$staff->name,
            'staff_mobile'=>$staff->mobile,
            'time_start'=>$p['time_start'],
            'time_end'=>$p['time_end'],
            'date_time_start'=>$date . ' ' . $p['time_start'],
          ];
          DB::table('staff_assignment')->insert($staff_assignment);
        }
      }
    }
  }

  private function savePreferredSlots($ticket_id, $input, $username = 'admin') {
    DB::table('ticket_preferred_slot')->where('ticket_id', $ticket_id)->delete();
  
    //Log::info('preferred slots ' . json_encode($input));
    $preferred_slots_count = $input['preferred_slots_count'];
    for($i=0; $i<$preferred_slots_count; $i++) {
      $preferred_slot = [
        'ticket_id' => $ticket_id,
        'date' => Carbon::createFromFormat('d M Y', $input['preferred_slot_date'.$i]),
        'time_start' => $input['preferred_slot_time_start'.$i],
        'time_end' => $input['preferred_slot_time_end'.$i],
        'updated_by'=>$username,
        'updated_on'=>Carbon::now()
      ];
      DB::table('ticket_preferred_slot')->insert($preferred_slot);
    }
  }

  public function searchTicket($input) {
    $s = "SELECT stat, ticket_code, ticket_id, title, category_id, quoted_price, requested_by, requested_on 
    from ticket
    where deleted_at is null ";
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
      $s .= " and ticket_code like '%".$input['ticket_code']."%'";
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
    if (isset($input['limit']) && $input['limit'] > 0) {
      $s .= " limit ".$input['limit'];
    }
    return DB::select($s);
  }


  public function paidTicket($ticket_id, $payment_method, $ref_no, $username = 'admin') {
    $ticket = Ticket::findOrFail($ticket_id);
    $ticket->stat = TicketStat::Paid;
    $ticket->payment_method = $payment_method;
    if (in_array($ticket->payment_method, ['B', 'Q'])) {
      $ticket->ref_no = $ref_no;
    }
    $ticket->save();

    $this->saveTicketHistory($ticket_id, 'paid', $username);
    return true;
  }

  public function invoiceTicket($ticket_id, $input, $username = 'admin')
  {
    $ticket = Ticket::findOrFail($ticket_id);
    $ticket->stat = TicketStat::Invoiced;
    if($input['quoted_price'] != '') {
      $ticket->quoted_price_original = $ticket->quoted_price;
      $ticket->quoted_price = $input['quoted_price'];
    }
    $ticket->save();

    $ticket = $this->getTicket($ticket_id);
    $this->populateTicketForView($ticket);

    $this->saveTicketHistory($ticket_id, 'invoice', $username);
    return $ticket;
  }

  public function getTicketAllByUsername($username)
  {
    $requester = Requester::where('username', $username)->first();
    $tickets = DB::table('ticket')
      ->whereNull('deleted_at')
      ->where('company_id', $requester->company_id)
      ->orderBy('requested_on', 'desc');
    if ($requester->admin) {
      return $tickets->get();
    }
    return $tickets->where('requested_by', $username)->get();
  }

  public function saveFrontendTicketPayment($ticket_id, $input) {
    $ticket = Ticket::findOrFail($ticket_id);
    $ticket->ref_no = $input['ref_no'];
    $ticket->payment_method = $input['payment_method'];
    $ticket->stat = TicketStat::PaymentIndicated;
    $ticket->save();
  }

  private function saveTicketHistory($ticket_id, $action, $username) {
    $ticket_history = new TicketHistory();
    $ticket_history->ticket_id = $ticket_id;
    $ticket_history->action = $action;
    $ticket_history->action_by = $username;
    $ticket_history->action_on = Carbon::now();
    $ticket_history->save();
  }

  public function getValidation() {
    return $this->validation;
  }

  private function getTicketHistory($ticket_id) {
    return TicketHistory::where('ticket_id', $ticket_id)->orderBy('action_on', 'desc')->get();
  }
  
  public function emailQuotation($ticket) {
    Mail::to($user = Requester::where('username', $ticket->requested_by)->first())
      ->send(new QuotationMail($ticket->ticket_id));
    //->queue(new QuotationMail($ticket_id));
  }
  
  public function emailTicketAccept($ticket) {
    Mail::to($user = Requester::where('username', $ticket->requested_by)->first())
      ->send(new TicketAcceptMail($ticket->ticket_id));
    //->queue(new TicketAcceptMail($ticket_id));
  }

  public function emailTicketInvoice($ticket) {
    Mail::to($user = Requester::where('username', $ticket->requested_by)->first())
      ->send(new InvoiceMail($ticket->ticket_id));
  }
  
  private function saveTicketSkills($ticket_id, $input) {
    DB::table('ticket_skill')->where('ticket_id', $ticket_id)->delete();
    
    if (isset($input['skills'])) {
      foreach($input['skills'] as $skill_id) {
        DB::table('ticket_skill')->insert([
          'ticket_id'=>$ticket_id,
          'skill_id'=>$skill_id
        ]);
      }
    }
  }
}