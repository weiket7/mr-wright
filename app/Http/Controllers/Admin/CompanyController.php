<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\DeleteLog;
use App\Models\Enums\MembershipStat;
use App\Models\Membership;
use App\Models\Services\CompanyService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
  protected $company_service;

  public function __construct(CompanyService $company_service) {
    $this->company_service = $company_service;
  }
  
  public function index(Request $request) {
    $input = [];
    if($request->isMethod("post")) {
      $input = $request->all();
      $request->flash();
    }
    $companies = $this->company_service->searchCompany($input);
    $data['search_result'] = 'Showing ' . count($companies) . ' company(s)';
    
    $data['companies'] = $companies;
    return view("admin/company/index", $data);
  }
  
  public function save(Request $request, $company_id = null) {
    $action = $company_id == null ? 'create' : 'update';
    $company = $company_id == null ? new Company() : Company::find($company_id);

    if($request->isMethod('post')) {
      $input = $request->all();
      if ($input["delete"] == "true") {
        $company->deleteCompany();
        (new DeleteLog())->saveDeleteLog('company', $company_id, $company->name, $this->getUsername());
        return redirect("admin/company")->with("msg", "Company deleted");
      }
      
      if (! $company->saveCompany($input)) {
        return redirect()->back()->withErrors($company->getValidation())->withInput($input);
      }
      return redirect('admin/company/save/' . $company->company_id)->with('msg', 'Company ' . $action . "d");
    }

    $data['action'] = $action;
    $data['company'] = $company;
    $data['offices'] = $company->getOffices($company_id);
    $membership_service = new Membership();
    $data['memberships'] = $membership_service->getMembershipDropdown(MembershipStat::Active);
    return view('admin/company/form', $data);
  }
  
}
  
  