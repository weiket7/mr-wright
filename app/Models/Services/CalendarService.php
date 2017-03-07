<?php

namespace App\Models\Services;

use Carbon\Carbon;
use DB;

class CalendarService
{
  protected $working_hour_service;

  public function __construct(WorkingHourService $working_hour_service)
  {
    $this->working_hour_service = $working_hour_service;
  }

  public function getStaffCalendar($date, $staff_ids) {
    $intervals = $this->working_hour_service->getWorkingIntervalsByDate($date);
    $blocked_intervals = $this->working_hour_service->getBlockedWorkingIntervalsByDate($date);

    $staffs = DB::table('staff')->whereIn('staff_id', $staff_ids)->select('name', 'staff_id')->get()->keyBy('staff_id');

    $staff_intervals = [];
    foreach($staff_ids as $staff_id) {
      foreach($intervals as $i) {
        $staff_intervals[$staff_id][$i] = ['text'=>'', 'background'=>''];
      }
    }

    $staff_assignments = $this->getStaffAssignments($date, $staff_ids);

    foreach($staff_ids as $staff_id) {
      if(isset($staff_assignments[$staff_id])) {
        $assignments = $staff_assignments[$staff_id];
        foreach ($assignments as $a) {
          $assignment_intervals = $this->working_hour_service->splitTimeRangeIntoInterval($a->time_start, $a->time_end);
          foreach ($assignment_intervals as $i) {
            $staff_intervals[$staff_id][$i]['text'] = $a->ticket_id;
          }
        }
      }
    }

    $res = [
      'intervals'=>$intervals,
      'staff_intervals'=>$staff_intervals,
      'staffs'=>$staffs,
    ];
    return $res;
  }

  public function getStaffAssignments($date, $staff_ids) {
    $data = DB::table('staff_assignment')
      ->where('date', $date)
      ->whereIn('staff_id', $staff_ids)
      ->select('staff_id', 'ticket_id', 'time_start', 'time_end')->get();

    $res = [];
    foreach($data as $d) {
      $res[$d->staff_id][] = $d;
    }
    return $res;
  }

  public function getStaffWithSkills($skills)
  {
    $staffs = DB::table('skill')
      ->join('staff_skill as ss', 'ss.skill_id', '=', 'skill.skill_id')
      ->join('staff', 'ss.staff_id', '=', 'staff.staff_id')
      ->whereIn('skill.name', $skills)->select('staff.staff_id', 'staff.name')->distinct()->get();
    return $staffs;
  }
}