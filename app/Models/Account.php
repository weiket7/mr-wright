<?php namespace App\Models;

use App\Models\Enums\RequesterStat;
use App\Models\Enums\RequesterType;
use App\Models\Enums\UserStat;
use App\Models\Enums\UserType;
use Eloquent, DB, Validator, Log;
use Hash;

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

  public function getRequesterForLogin($username) {
    $requester = DB::table('requester as r')
      ->join('user as u', 'r.username', '=', 'u.username')
      ->where('r.username', $username)->select('u.user_id', 'r.stat', 'password')->first();
    return $requester;
  }

  public function saveRegister($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }

    $input = array_map('trim', $input);

    $exist = Company::where('uen', $input['uen'])->count();
    if ($exist) {
      //TODO
      $this->informAdmin();
      return false;
    }

    $company = new Company();
    $company->name = $input['company_name'];
    $company->uen = $input['uen'];
    $company->addr = $input['addr'];
    $company->postal = $input['postal'];
    $company->save();

    $office = new Office();
    $office->company_id = $company->company_id;
    $office->name = $input['company_name'];
    $office->addr = $input['addr'];
    $office->postal = $input['postal'];
    $office->save();

    $requester = new Requester();
    $requester->office_id = $office->office_id;
    $requester->company_id = $company->company_id;
    $requester->name = $input['name'];
    $requester->username = $input['username'];
    $requester->designation = $input['designation'];
    $requester->email = $input['email'];
    $requester->mobile = $input['mobile'];
    $requester->type = RequesterType::Corporate;
    $requester->admin = false;
    $requester->stat = RequesterStat::PendingPayment;
    $requester->save();

    $user = new User();
    $user->username = $input['username'];
    $user->password = Hash::make($input['password']);
    $user->name = $input['name'];
    $user->type = UserType::Requester;
    $user->stat = UserStat::Inactive;
    $user->email = $input['email'];
    $user->save();

    return $input['username'];
  }


  public function getValidation() {
    return $this->validation;
  }

  private function informAdmin()
  {
  }
}