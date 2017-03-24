<?php

namespace App\Models\Services;

use App\Models\Company;
use App\Models\Office;
use App\Models\Requester;
use DB;
use Log;

class CompanyService
{

  public function getCompanyDropdown() {
    return Company::orderBy('name')->pluck('name', 'company_id');
  }

  public function getCompanyAll() {
    return Company::orderBy('name')->get();
  }

  public function searchCompany($input) {
    $s = "SELECT company_id, stat, name
    from company
    where 1 ";
    if (isset($input['stat']) && $input['stat'] != '') {
      $s .= " and stat = '$input[stat]'";
    }
    if (isset($input['name']) && $input['name'] != '') {
      $s .= " and name like '%".$input['name']."%'";
    }
    return DB::select($s);
  }


  public function searchOffice($input) {
    $s = "SELECT office_id, stat, name
    from office
    where 1 ";
    if (isset($input['stat']) && $input['stat'] != '') {
      $s .= " and stat = '$input[stat]'";
    }
    if (isset($input['name']) && $input['name'] != '') {
      $s .= " and name like '%".$input['name']."%'";
    }
    if (isset($input['company_id']) && $input['company_id'] != '') {
      $s .= " and company_id =".$input['company_id'];
    }
    return DB::select($s);
  }

  public function getOfficeAll()
  {
    return Office::orderBy('name')->get();
  }


  public function searchRequester($input) {
    $s = "SELECT requester_id, stat, name
    from requester
    where 1 ";
    if (isset($input['stat']) && $input['stat'] != '') {
      $s .= " and stat = '$input[stat]'";
    }
    if (isset($input['name']) && $input['name'] != '') {
      $s .= " and name like '%".$input['name']."%'";
    }
    if (isset($input['company_id']) && $input['company_id'] != '') {
      $s .= " and company_id =".$input['company_id'];
    }
    if (isset($input['office_id']) && $input['office_id'] != '') {
      $s .= " and office_id =".$input['office_id'];
    }
    Log::info($s);
    return DB::select($s);
  }

  public function getOfficeDropdown($company_id = null) {
    if($company_id == null) {
      return Office::pluck('name', 'company_id');
    }
    return Office::where('company_id', $company_id)->pluck('name', 'office_id');
  }

  public function getRequesterDropdown($office_id = null) {
    if($office_id == null) {
      return Requester::pluck('name', 'office_id');
    }
    return Requester::where('office_id', $office_id)->pluck('name', 'requester_id');
  }

  public function getRequesterAll()
  {
    return Requester::orderBy('name')->get();
  }

}