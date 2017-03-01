<?php

namespace App\Models\Services;

use Carbon\Carbon;
use DB;

class CalendarService
{
  public function __construct()
  {
  }

  public function getStaffCalendar($skills) {
    $staff_ids = DB::table('skill as s')->
    join('staff_skill as ss', 'ss.skill_id', '=', 's.skill_id')->
    whereIn('name', [$skills])->pluck('staff_id');

    
    return $staff_ids;
  }
}