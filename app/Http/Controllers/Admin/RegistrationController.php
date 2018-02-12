<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\Company;
use App\Models\DeleteLog;
use App\Models\Helpers\BackendHelper;
use App\Models\Office;
use App\Models\Services\PaymentService;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
  public function index(Request $request)
  {
    $registration_service = new Registration();
    if($request->isMethod("post")) {
      $input = $request->all();
      $request->flash();
    } else {
      $input["limit"] = 100;
    }
    $registrations = $registration_service->searchRegistration($input);
    $data['search_result'] = 'Showing ' . count($registrations) . ' registrations(s)';
    
    $data['registrations'] = $registrations;
    return view("admin/registration/index", $data);
  }

  public function save(Request $request, $registration_id) {
    $registration = Registration::findOrFail($registration_id);
    $registration_service = new Registration();
    $will_be_admin = $registration_service->willBeAdmin($registration->company_id);

    if($request->isMethod('post')) {
      $input = $request->all();
      if ($input["delete"] == "true") {
        $registration->deleteRegistration();
        (new DeleteLog())->saveDeleteLog('registration', $registration_id, $registration->username, $this->getUsername());
        return redirect("admin/registration")->with("msg", "Registration deleted");
      }
  
      $submit = $input['submit'];
      if(BackendHelper::stringContains($input['submit'], 'approve')){
        $registration = $registration_service->approveRegistration($registration, $input);
        if ($registration == false) {
          return redirect()->back()->withErrors($registration_service->getValidation())->withInput($input);
        }
        $registration_service->updateCompanyOfficeRequesterCount($registration->company_id);
        $registration_service->emailApproveRegistration($registration);
        return redirect('admin/registration/save/' . $registration->registration_id)->with('msg', "Registration approved");
      } else if(BackendHelper::stringContains($submit, 'reject')) {
        $registration = $registration_service->rejectRegistration($registration_id);
        return redirect('admin/registration/save/' . $registration->registration_id)->with('msg', "Registration rejected");
      }
    }
  
    $data['will_be_admin'] = $will_be_admin;
    $data['registration'] = $registration;
    $data['offices'] = Office::getOfficeDropdown($registration->company_id);
    $data['company'] = Company::find($registration->company_id);
    $data['office'] = Office::find($registration->office_id);
    $payment_service = new PaymentService();
    $data['payment_methods'] = $payment_service->getPaymentMethods();
    return view('admin/registration/form', $data);
  }

}