<?php namespace App\Models;


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

  private $rules = [
    'name'=>'required',
    'stat'=>'required',
  ];

  private $messages = [
    'name.required'=>'Name is required',
    'stat.required'=>'Status is required',
  ];

  public function saveRequester($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }

    $this->saveRequesterAsUser($input);

    if (isset($input['username'])) {
      $this->username = $input['username'];
    }
    $this->name = $input['name'];
    $this->stat = $input['stat'];
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