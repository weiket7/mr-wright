<?php namespace App\Models;

use Eloquent, DB, Validator, Log;

class ForgotPassword extends Eloquent
{
  public $table = 'forgot_password';
  protected $primaryKey = 'forgot_password_id';
  protected $validation;
  const CREATED_AT = 'created_on';
  const UPDATED_AT = 'updated_on';
  
  private $rules = [
    'email'=>'required',
  ];
  
  private $messages = [
    'email.required'=>'Email is required',
  ];
  
  public function saveForgotPassword($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }
  
    $this->token = str_random(20);
    $this->email = $input['email'];
    $this->consumed = false;
    $this->save();
  
    return true;
  }
  
  
  public function getValidation() {
    return $this->validation;
  }
}