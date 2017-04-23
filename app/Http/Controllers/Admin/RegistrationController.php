<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
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

    if($request->isMethod('post')) {
      $account_service = new Account();
      $account_service->approveRegister($registration_id);
      return redirect('admin/registration/save/' . $registration->registration_id)->with('msg', "Registration approved");
    }

    $data['registration'] = $registration;
    return view('admin/registration/form', $data);
  }

}