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
    $working_day_hour = $this->getAvailableWorkingDayHour();
  }

  public function splitTimeRangeIntoInterval($from_time, $to_time, $interval) {
    $s = strtotime("-$interval minutes", strtotime($from_time));
    $e = strtotime("-$interval minutes", strtotime($to_time));

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

  public function getAvailableWorkingDayHour() {
    return DB::table('working_day_hour')->get();
  }

  public function getBlockedWorkingDay() {
    //TODO from current date and onwards
    return DB::table('working_day_blocked')->get();
  }

  public function getAssignedWorkingHour() {

  }
}