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
  
  public function index(Request $request) {
    if($request->isMethod("post")) {
      $input = $request->all();
      $companies = $this->company_service->searchCompany($input);
      $request->flash();
      $data['search_result'] = 'Showing ' . count($companies) . ' company(s)';
    } else {
      $companies = $this->company_service->getCompanyAll();
    }
    $data['companies'] = $companies;
    return view("company/index", $data);
  }
  
  public function save(Request $request, $company_id = null) {
    $action = $company_id == null ? 'create' : 'update';
    $company = $company_id == null ? new Company() : Company::find($company_id);

    if($request->isMethod('post')) {
      $input = $request->all();
      if (!$company->saveCompany($input)) {
        return redirect()->back()->withErrors($company->getValidation())->withInput($input);
      }
      return redirect('company/save/' . $company->company_id)->with('msg', 'Company ' . $action . "d");
    }

    $data['action'] = $action;
    $data['company'] = $company;
    $data['offices'] = $company->getOffices($company_id);
    return view('company/form', $data);
  }
  
}
  
  