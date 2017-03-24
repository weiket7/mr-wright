<?php

namespace App\Http\Controllers;

use App\Models\Requester;
use App\Models\Services\CompanyService;
use App\Models\Services\OfficeService;
use Illuminate\Http\Request;

class RequesterController extends Controller
{
  protected $company_service;

  public function __construct(CompanyService $company_service)
  {
    $this->company_service = $company_service;
  }

  public function index(Request $request) {
    if($request->isMethod("post")) {
      $input = $request->all();
      $requesters = $this->company_service->searchRequester($input);
      $request->flash();
      $data['search_result'] = 'Showing ' . count($requesters) . ' requester(s)';
    } else {
      $requesters = $this->company_service->getRequesterAll();
    }
    $data['requesters'] = $requesters;
    $data['companies'] = $this->company_service->getCompanyDropdown();
    $data['offices'] = $this->company_service->getOfficeDropdown();
    return view("requester/index", $data);
  }

  public function save(Request $request, $requester_id = null) {
    $action = $requester_id == null ? 'create' : 'update';
    $requester = $requester_id == null ? new Requester() : Requester::find($requester_id);

    if($request->isMethod('post')) {
      $input = $request->all();
      if (!$requester->saveRequester($input)) {
        return redirect()->back()->withErrors($requester->getValidation())->withInput($input);
      }
      return redirect('requester/save/' . $requester->requester_id)->with('msg', 'Requester ' . $action . "d");
    }

    $data['action'] = $action;
    $data['requester'] = $requester;
    $data['companies'] = $this->company_service->getCompanyDropdown();
    $data['offices'] = $this->company_service->getOfficeDropdown();
    $data['requester'] = $requester;
    return view('requester/form', $data);
  }

}