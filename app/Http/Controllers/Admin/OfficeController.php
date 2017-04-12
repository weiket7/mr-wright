<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Office;
use App\Models\Services\CompanyService;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
  protected $company_service;

  public function __construct(CompanyService $company_service) {
    $this->company_service = $company_service;
  }

  public function index(Request $request) {
    if($request->isMethod("post")) {
      $input = $request->all();
      $offices = $this->company_service->searchOffice($input);
      $request->flash();
      $data['search_result'] = 'Showing ' . count($offices) . ' office(s)';
    } else {
      $offices = $this->company_service->getOfficeAll();
    }
    $data['offices'] = $offices;
    $data['companies'] = $this->company_service->getCompanyDropdown();
    return view("admin/office/index", $data);
  }

  public function save(Request $request, $office_id = null) {
    $action = $office_id == null ? 'create' : 'update';
    $office = $office_id == null ? new Office() : Office::find($office_id);

    if($request->isMethod('post')) {
      $input = $request->all();
      if (!$office->saveOffice($input)) {
        return redirect()->back()->withErrors($office->getValidation())->withInput($input);
      }
      return redirect('admin/office/save/' . $office->office_id)->with('msg', 'Office ' . $action . "d");
    }

    $data['action'] = $action;
    $data['office'] = $office;
    $data['companies'] = $this->company_service->getCompanyDropdown();
    return view('admin/office/form', $data);
  }

}