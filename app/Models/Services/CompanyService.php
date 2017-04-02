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
    $s = "SELECT company_id, code, stat, name
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
    $s = "SELECT office_id, o.stat, o.name, c.name as company_name
    from office as o
    inner join company as c on o.company_id = c.company_id
    where 1 ";
    if (isset($input['stat']) && $input['stat'] != '') {
      $s .= " and o.stat = '$input[stat]'";
    }
    if (isset($input['name']) && $input['name'] != '') {
      $s .= " and o.name like '%".$input['name']."%'";
    }
    if (isset($input['company_id']) && $input['company_id'] != '') {
      $s .= " and o.company_id =".$input['company_id'];
    }
    return DB::select($s);
  }

  public function getOfficeAll()
  {
    return DB::table('office as o')
      ->join('company as c', 'o.company_id', '=', 'c.company_id')
      ->select('o.office_id', 'o.name', 'c.company_id', 'c.name as company_name', 'o.stat')
      ->orderBy('name')->get();
  }

  public function searchRequester($input) {
    $s = "SELECT requester_id, r.stat, r.name, o.name as office_name, c.name as company_name
    from requester as r
    inner join office as o on r.office_id = o.office_id
    inner join company as c on r.company_id = c.company_id
    where 1 ";
    if (isset($input['stat']) && $input['stat'] != '') {
      $s .= " and r.stat = '$input[stat]'";
    }
    if (isset($input['name']) && $input['name'] != '') {
      $s .= " and r.name like '%".$input['name']."%'";
    }
    if (isset($input['company_id']) && $input['company_id'] != '') {
      $s .= " and r.company_id =".$input['company_id'];
    }
    if (isset($input['office_id']) && $input['office_id'] != '') {
      $s .= " and r.office_id =".$input['office_id'];
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
      return Requester::pluck('name', 'username');
    }
    return Requester::where('office_id', $office_id)->pluck('name', 'username');
  }

  public function getRequesterAll()
  {
    return DB::table('requester as r')
      ->join('office as o', 'o.office_id', '=', 'r.office_id')
      ->join('company as c', 'c.company_id', '=', 'r.company_id')
      ->select('requester_id', 'r.name', 'r.stat', 'r.company_id', 'r.office_id', 'c.name as company_name', 'o.name as office_name')
      ->orderBy('name')->get();
  }

}