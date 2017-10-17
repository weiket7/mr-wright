<?php namespace App\Models;

use App;
use App\Mail\RegisterExistingUenMail;
use App\Mail\RegistrationApproveMail;
use App\Mail\RegistrationSuccessMail;
use App\Models\Enums\RegistrationStat;
use App\Models\Enums\RequesterStat;
use App\Models\Enums\RequesterType;
use App\Models\Enums\UserStat;
use App\Models\Enums\UserType;
use Carbon\Carbon;
use Eloquent, DB, Validator, Log;
use Hash;
use Mail;

class Account extends Eloquent {
  protected $validation;

  public function saveAccount($input, $username) {
    $rules = [
      'name'=>'required',
      'designation'=>'required',
      'mobile'=>'required',
      'email'=>'required|email',
      'company_addr'=>'sometimes|required',
      'company_postal'=>'sometimes|required',
    ];
    $messages = [
      'name.required' => 'Name is required',
      'designation.required' => 'Designation is required',
      'mobile.required' => 'Mobile is required',
      'email.required' => 'Email is required',
      'email.email'=>'Email must be valid email',
      'company_addr.required' => 'Company address is required',
      'company_postal.required' => 'Company postal is required',
    ];
    $this->validation = Validator::make($input, $rules, $messages );
    if ( $this->validation->fails()) {
      return false;
    }
    
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
      'payment_method'=>'sometimes|required',
      'ref_no'=>'sometimes|required',
    ];
    $messages = [
      'membership_id.required' => 'Membership plan is required',
      'payment_method.required' => 'Payment method is required',
      'ref_no.required'=>'Ref no is required',
    ];
    $this->validation = Validator::make($input, $rules, $messages );
    if ( $this->validation->fails()) {
      return false;
    }
  
    $registration = Registration::find($registration_id);
    $membership = Membership::find($input['membership_id']);
    if ($membership->free_trial) {
      $registration->payment_method = "";
    } else {
      $registration->payment_method = $input['payment_method'];
      if ($registration->payment_method == 'Q' || $registration->payment_method == 'B')  {
        $registration->ref_no = $input['ref_no'];
      }
    }
    
    $this->assignMembership($registration, $membership);
    $registration->save();
  
    return $registration;
  }

  public function getRegistrationCode() {
    if (App::environment("local")) { //avoid paydollar duplicate merchant ref no
      return "MR_REG_".date('YmdHis');
    }
    $latest_registration_code = DB::table('registration')
      ->whereYear('created_on', '=', Carbon::now()->year)
      ->orderBy('created_on', 'desc')
      ->value('registration_code');

    if ($latest_registration_code == null) {
      $year = Carbon::now()->year;
      return 'REG_'.$year.'_00001';
    }

    $arr = explode('_' , $latest_registration_code);
    $number = $arr[2];
    return $arr[0].'_'.$arr[1].'_'.str_pad($number+1, 5, '0', STR_PAD_LEFT);
  }

  public function login($email, $password) {
    $user = DB::table('user')
      ->where('email', $email)->select('user_id', 'stat', 'password')->first();

    if ($user == null
      || ! Hash::check($password, $user->password)
      || $user->stat == UserStat::Inactive) {
      return false;
    }
    return true;
  }

  public function validateRegistration($input) {
    $rules = [
      'username'=>"required|min:6|unique:user,username",
      'email' =>'required|email|unique:user,email',
      'password'=>'required|min:6',
      'name'=>"required",
      'designation'=>"required",
      'mobile' => 'required',
      'company_name' => 'required',
      'uen' => 'required',
      'company_code' => 'min:2|max:5|alpha|required',
      'addr' => 'required',
      'postal' => 'required',
    ];

    $messages = [
      'username.required'=>'Username is required',
      'username.unique'=>'Username is not available',
      'username.min'=>'Username must be at least 6 characters',
      'email.required'=>'Email is required',
      'email.email'=>'Email must be valid email',
      'email.unique'=>'Email has been registered',
      'password.required'=>'Password is required',
      'password.min'=>'Password must be at least 6 characters',
      'name.required'=>'Name is required',
      'designation.required'=>'Designation is required',
      'mobile.required' => 'Mobile is required',
      'company_name.required'=>'Company registered name is required',
      'uen.required'=>'Unique Entity Number (UEN) is required',
      'company_code.required'=>'Company code is required',
      'company_code.min'=>'Company code must be between 2 and 5 letters',
      'company_code.max'=>'Company code must be between 2 and 5 letters',
      'company_code.alpha'=>'Company code must be alphabets',
      'addr.required' => 'Address is required',
      'postal.required' => 'Postal code is required',
    ];

    $this->validation = Validator::make($input, $rules, $messages);
    if ( $this->validation->fails()) {
      return false;
    }

    return true;
  }

  public function rejectRegistration($registration_id) {
    $registration = Registration::find($registration_id);
    $registration->stat = RegistrationStat::Rejected;
    $registration->save();
    return $registration;
  }

  public function approveRegistration($registration_id, $input = null) {
    $registration = Registration::find($registration_id);

    if ($input) {
      $rules = ['office_id'=>'required|sometimes'];
      $messages = ['office_id.required'=>'Office is required'];
      $this->validation = Validator::make($input, $rules, $messages );
      if ( $this->validation->fails()) {
        return false;
      }
    }

    if($registration->existing_uen) {
      $company = Company::find($registration->company_id);
      $office = Office::find($input['office_id']);
    } else {
      $company = new Company();
      $company->name = $registration->company_name;
      $company->code = $registration->company_code;
      $company->uen = $registration->uen;
      $company->addr = $registration->addr;
      $company->postal = $registration->postal;
      $company->membership_name = $registration->membership_name;
      $company->requester_limit = $registration->requester_limit;
      $company->effective_price = $registration->effective_price;
      $company->requester_count = 1;
      $company->save();

      $office = new Office();
      $office->company_id = $company->company_id;
      $office->name = $registration->company_name;
      $office->addr = $registration->addr;
      $office->postal = $registration->postal;
      $office->requester_count = 1;
      $office->save();
    }

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
    $requester->admin = $this->willBeAdmin($registration->company_id);
    $requester->save();

    $user = new User();
    $user->username = $registration->username;
    $user->password = $registration->password;
    $user->name = $registration->name;
    $user->type = UserType::Requester;
    $user->stat = UserStat::Active;
    $user->email = $registration->email;
    $user->save();

    $registration->company_id = $company->company_id;
    $registration->office_id = $office->office_id;
    $registration->requester_id = $requester->requester_id;
    $registration->stat = RegistrationStat::Approved;
    $registration->save();

    return $registration;
  }

  public function willBeAdmin($company_id) {
    return Requester::where('company_id', $company_id)->count() == 0;
  }
  
  public function updateCompanyOfficeRequesterCount($company_id) {
    $company = Company::find($company_id);
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
    $registration->stat = RegistrationStat::Pending;
    $registration->username = $input['username'];
    $registration->name = $input['name'];
    $registration->password = Hash::make($input['password']);
    $registration->designation = $input['designation'];
    $registration->mobile = $input['mobile'];
    $registration->email = $input['email'];
    $registration->uen = $input['uen'];
    $registration->company_name = $input['company_name'];
    $registration->company_code = strtoupper($input['company_code']);
    $registration->addr = $input['addr'];
    $registration->postal = $input['postal'];
    $registration->ip = $ip;
    $registration->registration_code = $this->getRegistrationCode();

    $registration->save();

    return $registration;
  }

  public function registerExistingUen($registration_id) {
    $registration = Registration::findOrFail($registration_id);
    $registration->existing_uen = true;
    $company = Company::where('uen', $registration->uen)->first();
    $registration->company_id = $company->company_id;
    $registration->save();
    return $registration;
  }

  public function getPendingRegistrations($company_id) {
    return Registration::where('company_id', $company_id)->where('stat', RegistrationStat::Pending)->get();
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

  public function emailRegistration($registration) {
    Mail::to($registration->email)
      ->send(new RegistrationSuccessMail($registration));
  }

  public function getValidation() {
    return $this->validation;
  }

  public function uenExist($uen) {
    return Company::where('uen', $uen)->count() > 0;
  }

  public function emailApproveRegistration($registration)
  {
    $user = User::where('email', $registration->email)->firstOrFail();
    Mail::to($user)
      ->send(new RegistrationApproveMail($registration));
  }
  
  public function hitRequesterLimit($company_id) {
    $company = Company::find($company_id);
    $requester_count = Requester::where('company_id', $company_id)->count();
    if ($requester_count >= $company->requester_limit) {
      return true;
    }
    return false;
  }
  
  private function assignMembership($registration, $membership)
  {
    $registration->membership_id = $membership->membership_id;
    $registration->membership_full_name = $membership->full_name;
    $registration->membership_name = $membership->name;
    $registration->requester_limit = $membership->requester_limit;
    $registration->effective_price = $membership->effective_price;
    $registration->free_trial = $membership->free_trial;
  }
}