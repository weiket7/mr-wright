<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Company;
use App\Models\Office;
use App\Models\Requester;
use App\Models\Services\CompanyService;
use App\Models\Services\PaymentService;
use Foo\Bar\A;
use Illuminate\Http\Request;
use App\Models\Registration;

class RegistrationController extends Controller
{
  public function index()
  {
    $data['registrations'] = Registration::orderBy('created_on', 'desc')->get();
    return view("admin/registration/index", $data);
  }

  public function save(Request $request, $registration_id) {
    $registration = Registration::findOrFail($registration_id);
    $account_service = new Account();
    $will_be_admin = $account_service->willBeAdmin($registration->company_id);
    //TODO when there are 5 registrations and approve one, need to void the rest?

    if($request->isMethod('post')) {
      $input = $request->all();
      $registration = $account_service->approveRegistration($registration_id, $input);
      if ($registration == false) {
        return redirect()->back()->withErrors($account_service->getValidation())->withInput($input);
      }
      $account_service->updateCompanyOfficeRequesterCount($registration->company_id);
      $account_service->emailApproveRegistration($registration);
      return redirect('admin/registration/save/' . $registration->registration_id)->with('msg', "Registration approved");
    }
  
    $data['will_be_admin'] = $will_be_admin;
    $data['registration'] = $registration;
    $company_service = new CompanyService();
    $data['offices'] = $company_service->getOfficeDropdown($registration->company_id);
    $data['company'] = Company::find($registration->company_id);
    $data['office'] = Office::find($registration->office_id);
    $payment_service = new PaymentService();
    $data['payment_methods'] = $payment_service->getPaymentMethods();
    return view('admin/registration/form', $data);
  }

}