<?php namespace App\Models;

use App\Models\Enums\RequesterStat;
use App\Models\Enums\UserStat;
use App\Models\Enums\UserType;
use Eloquent, DB, Validator, Log;
use Hash;
use Illuminate\Database\Eloquent\SoftDeletes;

class Requester extends Eloquent
{
  public $table = 'requester';
  protected $primaryKey = 'requester_id';
  const CREATED_AT = 'created_on';
  const UPDATED_AT = 'updated_on';
  protected $validation;
  protected $attributes = ['stat'=>UserStat::Active];
  use SoftDeletes;

  private $rules = [
    'username'=>"sometimes|required|unique:user,username",
    'name'=>"required",
    'password'=>'sometimes|min:6',
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
    'password.min'=>'Password must be at least 6 characters',
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


    $this->name = $input['name'];
    $this->stat = $input['stat'];
    $this->saveRequesterAsUser($input);
    
    if($this->requester_id == null) {
      $this->username = $input['username'];
    }
    $this->company_id = $input['company_id'];
    $this->office_id = $input['office_id'];
    $this->designation = $input['designation'];
    $this->email = $input['email'];
    $this->mobile = $input['mobile'];
    $this->admin = $input['admin'];
    $this->work = $input['work'];
    $this->preferred_contact = $input['preferred_contact'];
    $this->save();
    
    $company = new Registration();
    $company->updateCompanyOfficeRequesterCount($this->company_id);

    return true;
  }

  private function saveRequesterAsUser($input) {
    if ($this->requester_id == null) { //create
      $user = new User();
      $user->username = $input['username'];
    } else {
      $user = User::where('username', $this->username)->first();
    }

    $user->name = $input['name'];
    if ($input['stat'] == RequesterStat::Inactive) {
      $user->stat = UserStat::Inactive;
    } else if ($input['stat'] == RequesterStat::Active) {
      $user->stat = UserStat::Active;
    }

    $user->email = $input['email'];
    if ($input['password']) {
      $user->password = Hash::make($input['password']);
    }
    $user->type = UserType::Requester;
    $user->save();
  }

  public function saveRequesterFrontend($input, $username) {
    $rules = [
      'name'=>"required",
      'stat'=>'required',
      'office_id'=>'required',
      'email' =>'required|email',
      'mobile' => 'required',
    ];

    $messages = [
      'name.required'=>'Name is required',
      'stat.required'=>'Status is required',
      'office_id.required'=>'Office is required',
      'email.required'=>'Email is required',
      'email.email'=>'Email must be valid email',
      'mobile.required' => 'Mobile is required',
    ];

    $this->validation = Validator::make($input, $rules, $messages );
    $create_password_required = $this->requester_id == null && $input['password'] == '';
    if ( $this->validation->fails() || $create_password_required ) {
      if ($create_password_required) {
        $this->validation->errors()->add("password", "Password is required");
      }
      return false;
    }


    $this->name = $input['name'];
    if (isset($input['stat'])) {
      $this->stat = $input['stat'];
    }
    $this->saveRequesterAsUser($input);
    $this->office_id = $input['office_id'];
    $this->designation = $input['designation'];
    $this->email = $input['email'];
    $this->mobile = $input['mobile'];
    $this->work = $input['work'];
    //$this->preferred_contact = $input['preferred_contact'];
    $this->save();
    return true;
  }
  
  public function deleteRequester() {
    $this->delete();
    User::where('username', $this->username)->delete();
    Registration::where('username', $this->username)->delete();
  
    $company = new Registration();
    $company->updateCompanyOfficeRequesterCount($this->company_id);
  }
  
  public function getRequesterByUsername($username)
  {
    return DB::table('requester as r')
      ->join('company as c', 'r.company_id', '=', 'c.company_id')
      ->join('office as o', 'r.office_id', '=', 'o.office_id')
      ->select('r.name', 'admin', 'mobile', 'email', 'designation', 'username', 'r.company_id', 'r.office_id', 'r.stat',
        'c.name as company_name', 'c.stat as company_stat', 'c.addr as company_addr', 'c.postal as company_postal', 'uen',
        'o.name as office_name', 'o.stat as office_stat', 'o.addr as office_addr', 'o.postal as office_postal',
        'c.membership_name', 'c.requester_limit', 'effective_price', 'c.requester_count')
      ->where('username', $username)
      ->where('r.stat', RequesterStat::Active)->first();
  }
  
  public function searchRequester($input) {
    $s = "SELECT requester_id, r.stat, r.name, r.type, o.name as office_name, c.name as company_name
    from requester as r
    inner join office as o on r.office_id = o.office_id
    inner join company as c on r.company_id = c.company_id
    where r.deleted_at is null";
    if (isset($input['stat']) && $input['stat'] != '') {
      $s .= " and r.stat = '$input[stat]'";
    }
    if (isset($input['name']) && $input['name'] != '') {
      $s .= " and r.name like '%".$input['name']."%'";
    }
    if (isset($input['company_id']) && $input['company_id'] != '') {
      $s .= " and r.company_id =".$input['company_id'];
    }
    if (isset($input['office_id']) && $input['office_id'] != '') {
      $s .= " and r.office_id =".$input['office_id'];
    }
    if (isset($input['limit']) && $input['limit'] > 0) {
      $s .= " limit ".$input['limit'];
    }
    return DB::select($s);
  }
  
  public static function getRequesterDropdown($office_id = null) {
    if($office_id == null) {
      return Requester::pluck('name', 'username');
    }
    return Requester::where('office_id', $office_id)->pluck('name', 'username');
  }
  
  public function getValidation() {
    return $this->validation;
  }
}