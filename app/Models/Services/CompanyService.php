<?php

namespace App\Models\Services;

use App\Models\Company;
use DB;

class CompanyService
{

  public function getCompanyDropdown() {
    return Company::pluck('name', 'company_id');
  }

  public function getOfficeByCompany($company_id) {
    return DB::table('office')->where('company_id', $company_id)->pluck('name', 'office_id');
  }

  public function getRequesterByOffice($office_id) {
    return DB::table('requester')->where('office_id', $office_id)->pluck('name', 'requester_id');

  }
}