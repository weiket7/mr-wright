<?php

namespace App\Models\Services;

use App\Models\CategoryForTicket;
use App\Models\Enums\TicketStat;
use App\Models\Helpers\BackendHelper;
use App\Models\Quotation;
use App\Models\Ticket;
use Carbon\Carbon;
use DB;
use Log;

class TicketService
{
  public function __construct(WorkingHourService $working_hour_service)
  {
    $this->working_hour_service = $working_hour_service;
  }

  public function getTicket($ticket_id) {
    $ticket = Ticket::findOrNew($ticket_id);
    $ticket->issues = DB::table('ticket_issue')->where('ticket_id', $ticket_id)->orderBy('ticket_issue_id')->get();
    $ticket->staff_assignments = DB::table('staff_assignment')->where('ticket_id', $ticket_id)->get();
    $ticket->preferred_datetimes = DB::table('ticket_preferred_datetime')->where('ticket_id', $ticket_id)->get();
    return $ticket;
  }

  public function getCategoryDropdown() {
    return CategoryForTicket::pluck('name', 'category_for_ticket_id');
  }

  public function getSkills() {
    return DB::table('skill')->pluck('name', 'skill_id');
  }

  public function saveTicket($ticket_id, $input, $operator = 'admin') {
    $ticket = Ticket::findOrNew($ticket_id);
    $ticket->title = $input['title'];
    $ticket->category_id = $input['category_id'];
    $ticket->urgency = $input['urgency'];
    $ticket->company_id = $input['company_id'];
    $ticket->office_id = $input['office_id'];
    $ticket->requester_desc = $input['requester_desc'];
    $ticket->operator_desc = $input['operator_desc'];
      $ticket->requested_by = $input['requested_by'];
    $ticket->requested_on = Carbon::createFromFormat('d M Y', $input['requested_on']);
    if ($ticket_id == null) {
      $ticket->stat = TicketStat::Opened;
      $ticket->opened_by = $operator;
      $ticket->opened_on = Carbon::now();
    }
    $this->updateTicketIssues($ticket_id, $input, $operator);
    $this->updateStaffAssignments($ticket_id, $input, $operator);
    return $ticket->save();
  }

  public function sendQuotation($ticket_id, $operator = 'admin')
  {
    $ticket = Ticket::findOrFail($ticket_id);
    $ticket->stat = TicketStat::Quoted;
    $ticket->quoted_by = $operator;
    $ticket->quoted_on = Carbon::now();
    return $ticket->save();
  }

  public function acceptTicket($ticket_id, $operator = 'admin')
  {
    $ticket = Ticket::findOrFail($ticket_id);
    $ticket->stat = TicketStat::Accepted;
    $ticket->agreed_price = $ticket->quoted_price;
    $ticket->accepted_by = $operator;
    $ticket->accepted_on = Carbon::now();
    return $ticket->save();
  }

  public function completeTicket($ticket_id, $operator = 'admin')
  {
    $ticket = Ticket::findOrFail($ticket_id);
    $ticket->stat = TicketStat::Completed;
    $ticket->completed_by = $operator;
    $ticket->completed_on = Carbon::now();
    return $ticket->save();
  }

  private function updateTicketIssues($ticket_id, $input, $operator) {
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

  private function updateStaffAssignments($ticket_id, $input, $operator) {
    /* {
    "1":{
      "2017-03-07":["11:00", "11:15","11:30","11:45", "13:00", "13:15", "13:30", "13:45". "14:00", "14:15", "14:30", "14:45"],
      "2017-03-08":["10:15","10:30","10:45","11:00", "11:15","11:30","11:45"]
    },
    "2":{
      "2017-03-08":["11:00", "11:15","11:30","11:45"]
    } */
    //Staff 1, 7 March works 11am-12pm and 1pm-3pm, 8 March works 10am-12pm
    //Staff 2, 8 March works 11am-12pm
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
            'updated_by'=>$operator,
            'updated_on'=>Carbon::now(),
          ];
          DB::table('staff_assignment')->insert($staff_assignment);
        }
      }

    }
  }
}