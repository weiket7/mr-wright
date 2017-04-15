<?php namespace App\Models;

use App\Models\Enums\RequesterType;
use App\Models\Enums\UserStat;
use App\Models\Enums\UserType;
use Eloquent, DB, Validator, Log;
use Hash;

class Register extends Eloquent
{
  public $table = 'register';
  protected $primaryKey = 'register_id';
  const CREATED_AT = 'created_on';
  const UPDATED_AT = 'updated_on';
  protected $validation;
  public $timestamps = false;

  private $rules = [
    'username'=>"required|min:6|unique:user,username",
    'password'=>'required|min:6',
    //'password'=>'required|min:6|confirmed',
    'name'=>"required",
    'designation'=>"required",
    'email' =>'required|email',
    'mobile' => 'required',
    'company_name' => 'required',
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
    'company_name.required'=>'Company name is required',
    'email.required'=>'Email is required',
    'email.email'=>'Email must be valid email',
    'mobile.required' => 'Mobile is required',
    'addr.required' => 'Address is required',
    'postal.required' => 'Postal code is required',
  ];

  public function saveRegister($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }

    $requester = new Requester();
    $requester->name = $input['name'];
    $requester->username = $input['username'];
    $requester->designation = $input['designation'];
    $requester->email = $input['email'];
    $requester->mobile = $input['mobile'];
    $requester->company_name = $input['company_name'];
    $requester->addr = $input['addr'];
    $requester->postal = $input['postal'];
    $requester->type = RequesterType::Individual;
    $requester->save();

    $user = new User();
    $user->username = $input['username'];
    $user->password = Hash::make($input['password']);
    $user->name = $input['name'];
    $user->type = UserType::Requester;
    $user->stat = UserStat::Active;
    $user->email = $input['email'];
    $user->save();

    return $user->user_id;
  }


  public function getValidation() {
    return $this->validation;
  }
}