<?php

namespace App\Models\Services;

use App\Models\Company;
use DB;

class CompanyService
{
  public function getCompanyAll() {
    return Company::all();
  }

  public function getCompanyDropdown() {
    return Company::pluck('name', 'company_id');
  }

  public function getCompany($company_id) {
    $company = Company::findOrNew($company_id);
    $company->offices = DB::table('office')
      ->where('company_id', $company_id)
      ->select('office_id', 'name')->get();
    //vaR_dump($company->offices); exit;
    return $company;
  }
}