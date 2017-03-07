<?php

namespace App\Models\Services;

use Carbon\Carbon;
use DB;

class WorkingHourService
{
  const INTERVAL = 15;

  public function getWorkingIntervalsByDate($date) {
    $day = $this->getDayFromDate($date);
    $arr = DB::table('working_day_time')->where('day', $day)->select('time_start', 'time_end')->get();

    $res = [];
    foreach($arr as $a) {
      $intervals = $this->splitTimeRangeIntoInterval($a->time_start, $a->time_end);
      foreach($intervals as $i) {
        $res[] = $i;
      }
    }

    sort($res);
    return $res;
  }
  
  public function getBlockedWorkingIntervalsByDate($date) {
    $blocked_working_date_times =  DB::table('working_date_time_blocked')->where('date', $date)->select('time_start', 'time_end')->get();

    $blocked_intervals = [];
    foreach($blocked_working_date_times as $b) {
      $blocked_intervals[] = $this->splitTimeRangeIntoInterval($b->time_start, $b->time_end);
    }
    return $blocked_intervals;
  }

  public function isDateBlocked($date) {
    return DB::table('working_date_blocked')->where('date', $date)->count() > 0;
  }
  
  public function splitTimeRangeIntoInterval($time_start, $time_end) {
    $s = strtotime("-" . self::INTERVAL . " minutes", strtotime($time_start));
    $e = strtotime("-" . self::INTERVAL . " minutes", strtotime($time_end));

    $arr = [];
    while($s != $e) {
      $s = strtotime("+" . self::INTERVAL . " minutes", $s);
      $arr[] = $s;
    }

    $res = [];
    foreach($arr as $a) {
      $res[] = date('H:i', $a);
    }
    return $res;
  }

  public function mergeIntervalsIntoTimeRange($intervals) {
    $data = [];
    sort($intervals);
    $index = 0;

    $count = count($intervals);
    for($i=0; $i< $count; $i++) {
      if (isset($intervals[$i+1])) {
        $data[$index][] = $intervals[$i];
        if ($this->add15Minutes($intervals[$i]) != $intervals[$i+1]) {
          $index++;
        }
      } else {
        $data[$index][] = $intervals[$i];
      }
    }

    $res = [];
    foreach($data as $d) {
      $res[] = ['time_start'=>$d[0], 'time_end'=>$this->add15Minutes(end($d))];
    }
    return $res;
  }
  
  private function getDayFromDate($date) {
    return (int)date('N', strtotime($date));
  }

  private function add15Minutes($time) {
    return date('H:i', strtotime('+'.self::INTERVAL.' minutes', strtotime($time)));
  }

  public function isNonWorkingDay($date) {
    $day = $this->getDayFromDate($date);
    return DB::table('working_day_time')->where('day', $day)->count() == 0;
  }
    
}