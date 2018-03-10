<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\DeleteLog;
use App\Models\Office;
use App\Models\Requester;
use Illuminate\Http\Request;

class RequesterController extends Controller
{
  public function index(Request $request) {
    if($request->isMethod("post")) {
      $input = $request->all();
      $request->flash();
    } else {
      $input["limit"] = 100;
    }
    $requester_service = new Requester();
    $requesters = $requester_service->searchRequester($input);
    $data['search_result'] = 'Showing ' . count($requesters) . ' requester(s)';
  
    $data['requesters'] = $requesters;
    $data['companies'] = Company::getCompanyDropdown();
    $data['offices'] = Office::getOfficeDropdown();
    return view("admin/requester/index", $data);
  }

  public function save(Request $request, $requester_id = null) {
    if ($requester_id == null) {
      $action = 'create';
      $requester = new Requester();
    } else {
      $action = 'update';
      $requester = is_numeric ($requester_id) ? Requester::find($requester_id) : Requester::where('username', $requester_id)->first();
    }
    
    if($request->isMethod('post')) {
      $input = $request->all();
      if ($input["delete"] == "true") {
        $requester->deleteRequester();
        (new DeleteLog())->saveDeleteLog('requester', $requester_id, $requester->username, $this->getUsername());
        return redirect("admin/requester")->with("msg", "Requester deleted");
      }
  
      if (!$requester->saveRequester($input)) {
        return redirect()->back()->withErrors($requester->getValidation())->withInput($input);
      }
      return redirect('admin/requester/save/' . $requester->requester_id)->with('msg', 'Requester ' . $action . "d");
    }

    $data['action'] = $action;
    $data['requester'] = $requester;
    $data['companies'] = Company::getCompanyDropdown();
    $data['offices'] = Office::getOfficeDropdown($requester->company_id);
    $data['requester'] = $requester;
    return view('admin/requester/form', $data);
  }

}