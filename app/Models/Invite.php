<?php namespace App\Models;

use Eloquent, DB, Validator, Log;

class Invite extends Eloquent
{
  public $table = 'invite';
  protected $primaryKey = 'invite_id';
  protected $validation;

  public function getValidation() {
    return $this->validation;
  }

  private $rules = [
    'name'=>'required',
    'stat'=>'required',
  ];

  private $messages = [
    'name.required'=>'Name is required',
    'stat.required'=>'Status is required',
  ];


  public function saveInvite($input) {
    $rules = [
      'email'=>'required',
      'office_id'=>'required'
    ];
    $messages = [
      'email.required'=>'Email is required',
      'office_id.required'=>'Office is required',
    ];
    $this->validation = Validator::make($input, $rules, $messages );
    if ( $this->validation->fails()) {
      return false;
    }

    $invite = new Invite();
    $invite->email = $input['email'];
    $invite->office_id = $input['office_id'];
    $invite->token = str_random();
    $invite->save();
    return $invite;
  }

  public function acceptInvite($input, $token) {
    $invite = Invite::where('token', $token)->first();
    $invite->name = $input['name'];
    $invite->designation = $input['designation'];
    $invite->mobile = $input['mobile'];
    $invite->email = $input['email'];
    $invite->accepted = true;
    $invite->save();
  }


  public function saveRegistration($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }

    $this->name = $input['name'];
    $this->stat = $input['stat'];
    $this->save();
    return true;
  }


}