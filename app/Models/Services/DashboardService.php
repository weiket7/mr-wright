<?php

namespace App\Models\Services;

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
}