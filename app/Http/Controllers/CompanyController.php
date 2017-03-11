<?php

namespace App\Http\Controllers;

use App;
use App\Models\Company;
use App\Models\Services\CompanyService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
  protected $company_service;

  public function __construct(CompanyService $company_service)
  {
    $this->company_service = $company_service;
  }
  
  public function index()
  {
    $data['companies'] = Company::all();
    return view("company/index", $data);
  }
  
  public function save(Request $request, $company_id = null) {
    $data['action'] = $company_id == null ? 'create' : 'update';
    $data['company'] = $this->company_service->getCompany($company_id);
    return view('company/form', $data);
  }
  
}
  
  