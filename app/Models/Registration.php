<?php namespace App\Models;

use Eloquent, DB, Validator, Log;

class Registration extends Eloquent
{
  public $table = 'registration';
  protected $primaryKey = 'registration_id';
  protected $validation;
  const CREATED_AT = 'created_on';
  const UPDATED_AT = 'updated_on';

  private $rules = [
    'name'=>'required',
    'stat'=>'required',
  ];

  private $messages = [
    'name.required'=>'Name is required',
    'stat.required'=>'Status is required',
  ];


  public function getValidation() {
    return $this->validation;
  }

}