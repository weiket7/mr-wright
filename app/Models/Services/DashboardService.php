<?php

namespace App\Models\Services;

use App\Models\Enums\StaffAssignmentStat;
use App\Models\Enums\TicketStat;
use Carbon\Carbon;
use DB;

class DashboardService {
  public function getNewTicketCount() {
    return DB::table('ticket')->where('stat', TicketStat::Opened)->count();
  }
  
  public function getNewTicketValue() {
    return DB::table('ticket')->where('stat', TicketStat::Opened)->sum('quoted_price');
  }
  
  public function getCompletedTicketValue() {
    return DB::table('ticket')->where('stat', TicketStat::Completed)->sum('quoted_price');
  }
  
  public function getTicketsRecent() {
    return DB::table('ticket')->orderBy('requested_on', 'desc')->take(20)->get();
  }
  
  public function getCompletedTicketCountMonthly() {
    $s = "SELECT DATE_FORMAT(completed_on, '%d %b %Y') as date, count(1) as count from ticket
    where stat = :stat and completed_on >= :completed_on
    group by month(completed_on)";
    $p['stat'] = TicketStat::Completed;
    $p['completed_on'] = Carbon::now()->subYear(1);
    
    $data = DB::select($s, $p);
    
    $res = [];
    foreach($data as $d) {
      $res = [$d->date, $d->count];
    }
    return $res;
  }
  
  public function getCompletedTicketValueMonthly() {
    $s = "SELECT DATE_FORMAT(completed_on, '%d %b %Y') as date, sum(quoted_price) as value from ticket
    where stat = :stat and completed_on >= :completed_on
    group by month(completed_on)";
    $p['stat'] = TicketStat::Completed;
    $p['completed_on'] = Carbon::now()->subYear(1);
  
    $data = DB::select($s, $p);
  
    $res = [];
    foreach($data as $d) {
      $res = [$d->date, (int)$d->value];
    }
    return $res;
  }

  public function getStaffAssignmentsToday() {
    $data = DB::table('staff_assignment as sa')
      ->join('staff as s', 'sa.staff_id', '=', 's.staff_id')
      ->join('ticket as t', 'sa.ticket_id', '=', 't.ticket_id')
      ->where('sa.date', Carbon::today())
      ->select('s.name', 't.ticket_code', 'date', 'time_start', 'time_end')
      ->get();
    $res = [];
    foreach($data as $d) {
      $res[] = $d;
    }
    return $res;
  }

  public function getStaffAssignedTickets($username) {
    $ticket_ids = DB::table('staff_assignment')
      ->where('staff_username', $username)
      ->where('stat', StaffAssignmentStat::Pending)
      ->distinct()->pluck('ticket_id');

    $tickets = DB::table("ticket")->whereIn('ticket_id', $ticket_ids)->get();

    $ticket_service = new TicketService();
    foreach($tickets as $ticket) {
      $ticket->issues = $ticket_service->getTicketIssues($ticket->ticket_id);
      $ticket->otps = $ticket_service->getOtps($ticket->ticket_id);
      $ticket_service->populateTicketForView($ticket);
    }
    return $tickets;
  }
}