<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Services\CompanyService;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
  protected $company_service;

  public function __construct(CompanyService $company_service) {
    $this->company_service = $company_service;
  }

  public function index() {
    $data['offices'] = Office::all();
    return view("office/index", $data);
  }

  public function save(Request $request, $office_id = null) {
    $action = $office_id == null ? 'create' : 'update';
    $office = $office_id == null ? new Office() : Office::find($office_id);

    if($request->isMethod('post')) {
      $input = $request->all();
      if (!$office->saveOffice($input)) {
        return redirect()->back()->withErrors($office->getValidation())->withInput($input);
      }
      return redirect('office/save/' . $office->office_id)->with('msg', 'Office ' . $action . "d");
    }

    $data['action'] = $action;
    $data['office'] = $office;
    $data['companies'] = $this->company_service->getCompanyDropdown();
    return view('office/form', $data);
  }

}