<?php

namespace App\Models\Services;

use Carbon\Carbon;
use DB;

class CalendarService
{
  public function __construct()
  {
  }

  public function getStaffCalendar($staffs) {
    $staff_ids = $staffs->pluck('staff_id');
    
    return $staff_ids;
  }
  
  public function getAvailable
  
  public function getStaffWithSkills($skills)
  {
    /*$staffs = DB::table('skill as s')->
    join('staff_skill as ss', 'ss.skill_id', '=', 's.skill_id')->
    whereIn('s.name', [$skills])->select('staff_id')->get();*/
    var_dump($skills);
    $staffs = DB::table('skill')
      ->join('staff_skill as ss', 'ss.skill_id', '=', 'skill.skill_id')
      ->join('staff', 'ss.staff_id', '=', 'staff.staff_id')
      ->whereIn('skill.name', $skills)->select('staff.staff_id', 'staff.name')->get();
    var_dump($staffs);
    return $staffs;
  }
}