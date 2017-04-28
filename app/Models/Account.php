<?php namespace App\Models;

use App\Mail\RegisterExistingUenMail;
use App\Mail\RegistrationApproveMail;
use App\Models\Enums\PaymentMethodStat;
use App\Models\Enums\RequesterStat;
use App\Models\Enums\RequesterType;
use App\Models\Enums\UserStat;
use App\Models\Enums\UserType;
use Eloquent, DB, Validator, Log;
use Hash;
use Illuminate\Validation\Rules\In;
use Mail;

class Account extends Eloquent
{
  protected $validation;

  private $rules = [
    'username'=>"required|min:6|unique:user,username",
    'password'=>'required|min:6',
    //'password'=>'required|min:6|confirmed',
    'name'=>"required",
    'designation'=>"required",
    'email' =>'required|email',
    'mobile' => 'required',
    'company_name' => 'required',
    //'office_name' => 'required',
    'uen' => 'required',
    'addr' => 'required',
    'postal' => 'required',
  ];

  private $messages = [
    'username.required'=>'Username is required',
    'username.unique'=>'Username is not available',
    'username.min'=>'Username must be at least 6 characters',
    'password.required'=>'Password is required',
    'password.min'=>'Password must be at least 6 characters',
    //'password.confirmed'=>'Password must be confirmed',
    'name.required'=>'Name is required',
    'designation.required'=>'Designation is required',
    'company_name.required'=>'Company registered name is required',
    'uen.required'=>'Unique Entity Number (UEN) is required',
    //'office_name.required'=>'Office name is required',
    'email.required'=>'Email is required',
    'email.email'=>'Email must be valid email',
    'mobile.required' => 'Mobile is required',
    'addr.required' => 'Address is required',
    'postal.required' => 'Postal code is required',
  ];

  public function saveAccount($input, $username)
  {
    $requester = Requester::where('username', $username)->first();
    $requester->name = $input['name'];
    $requester->designation = $input['designation'];
    $requester->email = $input['email'];
    $requester->mobile = $input['mobile'];
    $requester->save();

    if ($requester->admin) {
      $company = Company::find($requester->company_id);
      $company->addr = $input['company_addr'];
      $company->postal = $input['company_postal'];
      $company->save();
    } else {
      $office = Office::find($requester->office_id);
      $office->name = $input['office_name'];
      $office->addr = $input['office_addr'];
      $office->postal = $input['office_postal'];
      $office->save();
    }

    $user = User::where('username', $username)->first();
    if ($input['password']) {
      $user->password = Hash::make($input['password']);
    }
    $user->name = $input['name'];
    $user->email = $input['email'];
    $user->save();
    return true;  
  }
  
  public function saveRegistrationMembership($registration_id, $input) {
    $rules = [
      'membership_id' => 'required',
      'payment_method'=>'required'
    ];
    $messages = [
      'membership_id.required' => 'Membership plan is required',
      'payment_method.required' => 'Payment method is required'
    ];
    $this->validation = Validator::make($input, $rules, $messages );
    if ( $this->validation->fails()) {
      return false;
    }
  
    $registration = Registration::find($registration_id);
    $registration->payment_method = $input['payment_method'];
  
    $membership = Membership::find($input['membership_id']);
    $registration->membership_id = $membership->membership_id;
    $registration->membership_name = $membership->name;
    $registration->requester_limit = $membership->requester_limit;
    $registration->effective_price = $membership->effective_price;
    $registration->save();
    
    return $registration;
  }

  public function getRequesterForLogin($username) {
    $requester = DB::table('requester as r')
      ->join('user as u', 'r.username', '=', 'u.username')
      ->where('r.username', $username)->select('u.user_id', 'r.stat', 'password')->first();
    return $requester;
  }

  public function validateRegistration($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails()) {
      return false;
    }

    return true;
  }

  public function approveRegistration($registration_id, $will_be_admin) {
    $registration = Registration::find($registration_id);

    $company = new Company();
    $company->name = $registration->company_name;
    $company->uen = $registration->uen;
    $company->addr = $registration->addr;
    $company->postal = $registration->postal;
    $company->membership_name = $registration->membership_name;
    $company->requester_limit = $registration->requester_limit;
    $company->effective_price = $registration->effective_price;
    $company->save();

    $office = new Office();
    $office->company_id = $company->company_id;
    $office->name = $registration->company_name;
    $office->addr = $registration->addr;
    $office->postal = $registration->postal;
    $office->save();

    $requester = new Requester();
    $requester->office_id = $office->office_id;
    $requester->company_id = $company->company_id;
    $requester->name = $registration->name;
    $requester->username = $registration->username;
    $requester->designation = $registration->designation;
    $requester->email = $registration->email;
    $requester->mobile = $registration->mobile;
    $requester->type = RequesterType::Corporate;
    $requester->admin = false;
    $requester->stat = RequesterStat::Active;
    $requester->admin = $will_be_admin;
    $requester->save();

    $user = new User();
    $user->username = $registration->username;
    $user->password = $registration->password;
    $user->name = $registration->name;
    $user->type = UserType::Requester;
    $user->stat = UserStat::Inactive;
    $user->email = $registration->email;
    $user->save();

    $registration->approved = true;
    $registration->company_id = $company->company_id;
    $registration->office_id = $office->office_id;
    $registration->requester_id = $requester->requester_id;
    $registration->approved = true;
    $registration->save();

    return $registration;
  }
  
  public function updateCompanyOfficeRequesterCount($company_id) {
    $company = Company::findOrFail($company_id);
    $company->requester_count = Requester::where('company_id', $company_id)->count();
    $company->save();
    
    $offices = Office::where('company_id', $company_id)->get();
    foreach($offices as $office) {
      $office->requester_count = Requester::where('office_id', $office->office_id)->count();
      $office->save();
    }
    return true;
  }

  public function saveRegistration($input, $ip) {
    $input = array_map('trim', $input);

    $registration = new Registration();
    $registration->username = $input['username'];
    $registration->name = $input['name'];
    $registration->password = Hash::make($input['password']);
    $registration->designation = $input['designation'];
    $registration->mobile = $input['mobile'];
    $registration->email = $input['email'];
    $registration->uen = $input['uen'];
    $registration->company_name = $input['company_name'];
    $registration->addr = $input['addr'];
    $registration->postal = $input['postal'];
    $registration->ip = $ip;

    $registration->save();

    return $registration;
  }

  public function registerExistingUenAndEmailAdmin($registration_id) {
    $registration = Registration::findOrFail($registration_id);
    $registration->register_existing_uen = true;
    $company = Company::where('uen', $registration->uen)->first();
    $registration->company_id = $company->company_id;
    $registration->save();
    return $registration;
  }

  public function emailRegisterExistingUen($registration) {
    $requesters = DB::table('requester as r')
      ->join('company as c', 'r.company_id', '=', 'c.company_id')
      ->where('c.company_id', $registration->company_id)
      ->select('r.name', 'c.name as company_name', 'email')->get();
    foreach($requesters as $requester) {
      Mail::to($requester->email)
        ->send(new RegisterExistingUenMail($registration, $requester));
  }

return $registration->username;
  }

  public function getValidation() {
    return $this->validation;
  }

  public function uenExist($uen) {
    return Company::where('uen', $uen)->count() > 0;
  }

  public function getPaymentMethods($active = false) {
    $payment_methods = PaymentMethod::orderBy('pos');
    if ($active) {
      $payment_methods->where('stat', PaymentMethodStat::Active);
    }
    return $payment_methods->pluck('name', 'value');
  }

  public function emailApproveRegistration($registration)
  {
    $user = User::where('username', $registration->username)->firstOrFail();
    Mail::to($user)
      ->send(new RegistrationApproveMail($registration));
  }

}