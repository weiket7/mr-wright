<?php

namespace App\Models\Services;


use App\Models\Company;

class CompanyService
{
  public function getCompanyAll() {
    return Company::all();
  }
}