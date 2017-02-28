<?php

namespace App\Models\Services;

use Carbon\Carbon;
use DB;

class WorkingHourService
{
  const INTERVAL = 15;

  public function getAvailableSlotByTicketCategory() {

  }

  //working day hour, can be used to exclude regular lunch hour
  //mon       tues      wed,      thurs,    fri       sat
  //10am-7pm  10am-7pm  10am-7pm  10am-7pm  10am-4pm  10-1pm

  //blocked day = next mon
  //mon       tues      wed,      thurs,    fri       sat
  //10am-7pm  10am-7pm  10am-7pm  10am-4pm  10-1pm

  //blocked date and hour = next wed 1-3pm
  //blocked date and hour = next fri 4-6pm
  //tues      wed,      thurs,    fri       sat
  //10am-7pm  10am-1pm  10am-7pm  10am-4pm  10-1pm
  //          3pm-7pm

  //1=>['10:00', '10:30', '11:00'..]
  //2=>['10:00', '10:30', '11:00'..]

  //for one staff
  //assigned date and hour
  //next tues 10am-12pm, next tues 3-5pm
  //next thurs 10am-3pm
  //tues      wed,      thurs,    fri       sat
  //12-3pm  10am-1pm    3-7pm     10am-4pm  10-1pm
  //5-7pm   3pm-7pm

  //'2017-03-01'=>['12:00', '12:30'..'14:45', '17:00'..'18:45']
  //'2017-03-01'=>['12:00-15:00', '17:00-19:00']

  public function getAvailableSlots() {
    $working_day_hour = $this->getAvailableWorkingDayTimes();
  }

  public function splitTimeRangeIntoInterval($time_start, $time_end, $interval) {
    $s = strtotime("-$interval minutes", strtotime($time_start));
    $e = strtotime("-$interval minutes", strtotime($time_end));

    $arr = [];
    while($s != $e) {
      $s = strtotime("$interval minutes", $s);
      $arr[] = $s;
    }

    $res = [];
    foreach($arr as $a) {
      $res[] = date('H:i', $a);
    }
    return $res;
  }

  public function getAvailableWorkingSlots() {
    $arr = $this->getAvailableWorkingDayTimes();

    $res = [];
    foreach($arr as $day => $periods) {
      foreach($periods as $p) {
        $intervals = $this->splitTimeRangeIntoInterval($p['time_start'], $p['time_end'], 15);
        foreach($intervals as $i) {
          $res[$day][] = $i;
        }
      }
    }

    $blocked_working_days = $this->getBlockedWorkingDays();
    foreach($blocked_working_days as $b) {
      unset($res[$b]);
    }
    return $res;
  }

  public function getAvailableWorkingDayTimes() {
    $arr = DB::table('working_day_time')->get();
    $res = [];
    foreach($arr as $a) {
      $res[$a->day][] = ['time_start'=>$a->time_start, 'time_end'=>$a->time_end];
    }
    return $res;
  }

  public function getBlockedWorkingDays() {
    //TODO >= current date
    $arr = DB::table('working_date_blocked')->pluck('date');

    $res = [];
    foreach($arr as $a) {
      $res[] = (int)date('N', strtotime($a));
    }
    return $res;
  }

  public function getAssignedWorkingHour() {

  }
}