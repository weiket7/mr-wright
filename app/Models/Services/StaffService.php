<?php

namespace App\Models\Services;

use Carbon\Carbon;
use DB;
use App\Models\Staff;

class StaffService
{
  public function getStaffDropdown() {
    return Staff::pluck('name', 'staff_id');
  }

}