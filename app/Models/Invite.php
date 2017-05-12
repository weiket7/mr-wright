<?php namespace App\Models;

use App\Models\Enums\RequesterStat;
use App\Models\Enums\RequesterType;
use App\Models\Enums\UserStat;
use App\Models\Enums\UserType;
use Eloquent, DB, Validator, Log;
use Hash;

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


  public function saveInvite($input, $username) {
    $rules = [
      'email'=>'required|unique:requester,email',
      'office_id'=>'required'
    ];
    $messages = [
      'email.required'=>'Email is required',
      'email.unique'=>'Email has been registered',
      'office_id.required'=>'Office is required',
    ];
    $this->validation = Validator::make($input, $rules, $messages );
    if ( $this->validation->fails()) {
      return false;
    }

    $invite = new Invite();
    $invite->email = $input['email'];
    $invite->company_id = Requester::where('username', $username)->value('company_id');
    $invite->office_id = $input['office_id'];
    $invite->token = str_random();
    $invite->invited_by = $username;
    $invite->save();
    return $invite;
  }

  public function acceptInvite($input, $token) {
    $invite = Invite::where('token', $token)->first();
    $invite->username = $input['username'];
    $invite->name = $input['name'];
    $invite->designation = $input['designation'];
    $invite->mobile = $input['mobile'];
    $invite->email = $input['email'];
    $invite->accepted = true;
    $invite->save();
    
    Requester::where('username', $invite->invited_by)->firstOrFail();
    $requester = new Requester();
    $requester->company_id = $invite->company_id;
    $requester->office_id = $invite->office_id;
    $requester->username = $invite->username;
    $requester->name = $invite->name;
    $requester->designation = $invite->designation;
    $requester->mobile = $invite->mobile;
    $requester->email = $invite->email;
    $requester->type = RequesterType::Corporate;
    $requester->admin = false;
    $requester->stat = RequesterStat::Active;
    $requester->save();
  
    $user = new User();
    $user->username = $invite->username;
    $user->password = Hash::make($input['password']);
    $user->name = $invite->name;
    $user->type = UserType::Requester;
    $user->stat = UserStat::Active;
    $user->email = $invite->email;
    $user->save();
    return $user;
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