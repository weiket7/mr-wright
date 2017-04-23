<?php namespace App\Models;

use Eloquent, DB, Validator, Log;

class Registration extends Eloquent
{
  public $table = 'registration';
  protected $primaryKey = 'registration_id';
  protected $validation;

  private $rules = [
    'name'=>'required',
    'stat'=>'required',
  ];

  private $messages = [
    'name.required'=>'Name is required',
    'stat.required'=>'Status is required',
  ];

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


  public function getValidation() {
    return $this->validation;
  }

}