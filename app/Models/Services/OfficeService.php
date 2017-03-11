<?php

namespace App\Models\Services;

use App\Models\Office;
use Carbon\Carbon;
use DB;

class OfficeService
{
  public function getOfficeDropdown() {
    return Office::pluck('name', 'company_id');
  }
}