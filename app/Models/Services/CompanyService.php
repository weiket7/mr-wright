<?php

namespace App\Models\Services;


use App\Models\Company;

class CompanyService
{
  public function getCompanyAll() {
    return Company::all();
  }

  public function getCompanyDropdown() {
    return Company::pluck('name', 'company_id');
  }
}