<?php namespace App\Models;

use Eloquent, DB, Validator, Log;

class Contact extends Eloquent
{
  public $table = 'contact';
  protected $primaryKey = 'contact_id';
  const CREATED_AT = 'created_on';
  const UPDATED_AT = 'updated_on';
  protected $validation;
  public $timestamps = false;
  
  private $rules = [
    'name'=>'required',
    'email'=>'required',
    'mobile'=>'required',
    'message'=>'required',
  ];
  
  private $messages = [
    'name.required'=>'Name is required',
    'email.required'=>'Email is required',
    'mobile.required'=>'Mobile is required',
    'message.required'=>'Message is required',
  ];
  
  public function saveContact($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }
  
    $this->company_name = $input['company_name'];
    $this->name = $input['name'];
    $this->email = $input['email'];
    $this->mobile = $input['mobile'];
    $this->message = $input['message'];
    $this->source = $input['source'];
    if (isset($input['promo_code'])) {
      $this->promo_code = $input['promo_code'];
    }
    $this->save();
    return true;
  }
  
  
  public function getValidation() {
    return $this->validation;
  }
}