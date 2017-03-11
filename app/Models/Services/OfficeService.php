<?php

namespace App\Models\Services;

use App\Models\Office;
use Carbon\Carbon;
use DB;

class OfficeService
{
  public function getOfficeAll() {
    return Office::all();
  }

  public function getOfficeDropdown() {
    return Office::pluck('name', 'company_id');
  }

  public function getOffice($company_id) {
    $company = Office::findOrNew($company_id);
    return $company;
  }
}