<?php

namespace App\Http\Controllers;

use App\Models\Requester;
use App\Models\Services\CompanyService;
use App\Models\Services\OfficeService;
use Illuminate\Http\Request;

class RequesterController extends Controller
{
  protected $company_service;
  protected $office_service;

  public function __construct(CompanyService $company_service, OfficeService $office_service)
  {
    $this->company_service = $company_service;
    $this->office_service = $office_service;
  }

  public function index()
  {
    $data['requesters'] = Requester::all();
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
    $data['offices'] = $this->office_service->getOfficeDropdown();
    $data['requester'] = $requester;
    return view('requester/form', $data);
  }

}