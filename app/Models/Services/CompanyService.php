<?php

namespace App\Models\Services;

use App\Models\Company;
use DB;

class CompanyService
{

  public function getCompanyDropdown() {
    return Company::pluck('name', 'company_id');
  }
}