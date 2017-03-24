<?php namespace App\Models;


use App\Models\Enums\UserType;
use Eloquent, DB, Validator, Log;
use Hash;

class Operator extends Eloquent
{
  public $table = 'user';
  protected $primaryKey = 'user_id';
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

  public function getOperatorAll() {
    return Operator::where('type', UserType::Operator)->orderBy('stat')->orderBy('name')->get();
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