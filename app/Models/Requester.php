<?php namespace App\Models;


use App\Models\Enums\UserStat;
use Eloquent, DB, Validator, Log;
use Hash;

class Requester extends Eloquent
{
  public $table = 'requester';
  protected $primaryKey = 'requester_id';
  const CREATED_AT = 'created_on';
  const UPDATED_AT = 'updated_on';
  protected $validation;
  public $timestamps = false;
  protected $attributes = ['stat'=>UserStat::Active];

  private $rules = [
    'username'=>"sometimes|required|unique:user,username",
    'name'=>"required",
    'stat'=>'required',
    'password'=>'required',
    'company_id'=>'required',
    'office_id'=>'required',
    'email'=>'required|email',
  ];

  private $messages = [
    'username.required'=>'Username is required',
    'username.unique'=>'Username is not available',
    'name.required'=>'Name is required',
    'stat.required'=>'Status is required',
    'password.required'=>'Password is required',
    'company_id.required'=>'Company is required',
    'office_id.required'=>'Office is required',
    'email.required'=>'Email is required',
    'email.email'=>'Email must be valid email',
  ];

  public function saveRequester($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }

    $this->saveRequesterAsUser($input);

    $this->name = $input['name'];
    if (isset($input['stat'])) $this->stat = $input['stat'];
    $this->company_id = $input['company_id'];
    $this->office_id = $input['office_id'];
    $this->designation = $input['designation'];
    $this->email = $input['email'];
    $this->mobile = $input['mobile'];
    $this->work = $input['work'];
    $this->preferred_contact = $input['preferred_contact'];
    $this->save();

    return true;
  }

  public function getValidation() {
    return $this->validation;
  }

  private function saveRequesterAsUser($input)
  {
    if ($this->requester_id == null) { //create
      $user = new User();
    } else {
      $user = User::where('username', $this->username)->first();
    }
    if (isset($input['username'])) {
      $user->username = $input['username'];
    }
    $user->name = $input['name'];
    $user->stat = $input['stat'];
    $user->email = $input['email'];
    if ($input['password']) {
      $user->password = Hash::make($input['password']);
    }
    $user->save();
  }
}