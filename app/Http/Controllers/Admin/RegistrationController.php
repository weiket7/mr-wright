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
    $data['registrations'] = Registration::all();
    return view("admin/registration/index", $data);
  }

  public function save(Request $request, $registration_id) {
    $registration = Registration::findOrFail($registration_id);
    $will_be_admin = Requester::where('company_id', $registration->company_id)->count() == 0;

    if($request->isMethod('post')) {
      $account_service = new Account();
      $account_service->approveRegistration($registration_id, $will_be_admin);
      return redirect('admin/registration/save/' . $registration->registration_id)->with('msg', "Registration approved");
    }
  
    $data['will_be_admin'] = $will_be_admin;
    $data['registration'] = $registration;
    return view('admin/registration/form', $data);
  }

}