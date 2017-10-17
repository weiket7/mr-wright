<?php namespace App\Models;

use App\Models\Enums\UserStat;
use App\Models\Enums\UserType;
use Eloquent, DB, Validator, Log;
use Hash;
use Illuminate\Database\Eloquent\SoftDeletes;

class Operator extends Eloquent
{
  public $table = 'user';
  protected $primaryKey = 'user_id';
  protected $validation;
  public $timestamps = false;
  protected $attributes = ['stat'=>UserStat::Active];
  use SoftDeletes;

  private $rules = [
    'username'=>"sometimes|required|unique:user,username",
    'password'=>'sometimes|min:6',
    'stat'=>'required',
    'name'=>'required',
    'role_id'=>'required',
  ];

  private $messages = [
    'username.required'=>'Username is required',
    'username.unique'=>'Username is not available',
    'password.min'=>'Password must be at least 6 characters',
    'stat.required'=>'Status is required',
    'name.required'=>'Name is required',
    'role_id.required'=>'Role is required',
  ];

  public function getOperatorAll() {
    return Operator::where('type', UserType::Operator)
      ->orderBy('stat')->orderBy('name')->get();
  }

  public function saveOperator($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    
    $create_password_required = $this->user_id == null && $input['password'] == '';
    if ( $this->validation->fails() || $create_password_required ) {
      if ($create_password_required) {
        $this->validation->errors()->add("password", "Password is required");
      }
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
    $this->role_id = $input['role_id'];
    $this->type = UserType::Operator;
    
    $this->save();
    return true;
  }
  
  public function deleteOperator() {
    $this->delete();
  }

  public function getValidation() {
    return $this->validation;
  }
}