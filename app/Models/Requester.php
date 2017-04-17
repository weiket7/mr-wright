<?php namespace App\Models;


use App\Models\Enums\RequesterStat;
use App\Models\Enums\RequesterType;
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
    'company_id'=>'required',
    'office_id'=>'required',
    'email' =>'required|email',
    'mobile' => 'required',
  ];

  private $messages = [
    'username.required'=>'Username is required',
    'username.unique'=>'Username is not available',
    'name.required'=>'Name is required',
    'stat.required'=>'Status is required',
    'company_id.required'=>'Company is required',
    'office_id.required'=>'Office is required',
    'email.required'=>'Email is required',
    'email.email'=>'Email must be valid email',
    'mobile.required' => 'Mobile is required',
  ];

  public function saveRequester($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    $create_password_required = $this->requester_id == null && $input['password'] == '';
    if ( $this->validation->fails() || $create_password_required ) {
      if ($create_password_required) {
        $this->validation->errors()->add("password", "Password is required");
      }
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

  public function getRequesterByUsername($username)
  {
    return DB::table('requester as r')
      ->join('company as c', 'r.company_id', '=', 'c.company_id')
      ->join('office as o', 'r.office_id', '=', 'o.office_id')
      ->select('r.name', 'is_admin', 'mobile', 'email', 'designation', 'username', 'r.company_id', 'r.office_id',
        'c.name as company_name', 'o.name as office_name', 'uen', 'o.addr as office_addr', 'o.postal as office_postal')
      ->where('username', $username)
      ->where('r.stat', RequesterStat::Active)->first();
  }
}