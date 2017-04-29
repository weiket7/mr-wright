<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Requester;
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
      $registration = $account_service->approveRegistration($registration_id);
      //update company and office requester count
      $account_service->updateCompanyOfficeRequesterCount($registration->company_id);
      $account_service->emailApproveRegistration($registration);
      return redirect('admin/registration/save/' . $registration->registration_id)->with('msg', "Registration approved");
    }
  
    $data['will_be_admin'] = $will_be_admin;
    $data['registration'] = $registration;
    return view('admin/registration/form', $data);
  }

}