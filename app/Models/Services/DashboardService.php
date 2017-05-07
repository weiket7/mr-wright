<?php

namespace App\Models\Services;

use App\Models\Enums\StaffAssignmentStat;
use App\Models\Enums\TicketStat;
use Carbon\Carbon;
use DB;

class DashboardService
{
  public function getTicketsRecent() {
    return DB::table('ticket')->orderBy('updated_on', 'desc')->take(20)->get();
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