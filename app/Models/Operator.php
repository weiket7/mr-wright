<?php namespace App\Models;


use App\Models\Enums\Role;
use App\Models\Enums\UserStat;
use App\Models\Enums\UserType;
use Eloquent, DB, Validator, Log;
use Hash;

class Operator extends Eloquent
{
  public $table = 'user';
  protected $primaryKey = 'user_id';
  protected $validation;
  public $timestamps = false;
  protected $attributes = ['stat'=>UserStat::Active];

  private $rules = [
    'username'=>"sometimes|required|unique:user,username",
    'stat'=>'required',
    'name'=>'required',
    'role'=>'required',
  ];

  private $messages = [
    'username.required'=>'Username is required',
    'username.unique'=>'Username is not available',
    'stat.required'=>'Status is required',
    'name.required'=>'Name is required',
    'role.required'=>'Role is required',
  ];

  public function getOperatorAll() {
    return Operator::whereIn('role', [Role::Operator, Role::Admin, Role::Finance])->orderBy('stat')->orderBy('name')->get();
  }

  public function saveOperator($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }

    $this->name = $input['name'];
    $this->stat = $input['stat'];
    if (isset($input['username'])) {
      $this->username = $input['username'];
    }
    if ($input['password']) {
      $this->password = Hash::make($input['password']);
    }
    $this->email = $input['email'];
    $this->save();
    return true;
  }


  public function getValidation() {
    return $this->validation;
  }
}