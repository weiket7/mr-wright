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

  public function getStaffCalendarWithSkills($date, $skills) {
    $intervals = $this->working_hour_service->getWorkingIntervalsByDate($date);
    $is_date_blocked = $this->working_hour_service->isDateBlocked($date);
    $blocked_intervals = $this->working_hour_service->getBlockedWorkingIntervalsByDate($date);

    $staffs = $this->getStaffWithSkills($skills);
    $staff_ids = $staffs->pluck('staff_id');
    $staff_assignments = $this->getStaffAssignments($date, $staff_ids);

    $staff_intervals = [];
    foreach($staff_ids as $staff_id) {
      foreach($intervals as $i) {
        $staff_intervals[$staff_id][$i] = ['text'=>'A', 'background'=>''];
      }
    }

    foreach($staff_ids as $staff_id) {
      if(isset($staff_assignments[$staff_id])) {
        $assignments = $staff_assignments[$staff_id];
        foreach ($assignments as $a) {
          $intervals = $this->working_hour_service->splitTimeRangeIntoInterval($a->time_start, $a->time_end, 15);
          foreach ($intervals as $i) {
            $staff_intervals[$staff_id][$i]['ticket_id'] = $a->ticket_id;
          }
        }
      }
    }

    return $staff_intervals;
  }

  private function arrayContains($haystack, $needle) {
    //http://nickology.com/2012/07/03/php-faster-array-lookup-than-using-in_array/
    if (isset($haystack[$needle]))
    {
      return true;
    }
    return false;
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
    //var_dump($staffs);
    return $staffs->keyBy('staff_id');
  }
}