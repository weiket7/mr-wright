<?php

namespace App\Models\Services;

use Carbon\Carbon;
use DB;
use App\Models\Staff;

class StaffService
{
  public function getStaffAll() {
    return Staff::all();
  }

  public function getStaffDropdown() {
    return Staff::pluck('name', 'staff_id');
  }

  public function getStaff($staff_id) {
    $staff = Staff::findOrNew($staff_id);
    $staff->skills = DB::table('skill as sk')
      ->join('staff_skill as ss', 'ss.skill_id', '=', 'sk.skill_id')
      ->join('staff as st', 'ss.staff_id', '=', 'st.staff_id')
      ->where('ss.staff_id', $staff_id)->select('sk.skill_id', 'sk.name')->get();
    return $staff;
  }
}