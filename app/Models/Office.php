<?php namespace App\Models;

use CommonHelper;
use Eloquent, DB, Validator, Input;

class Office extends Eloquent
{
  public $table = 'office';
  protected $primaryKey = 'office_id';
  const CREATED_AT = 'created_on';
  const UPDATED_AT = 'updated_on';
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

  public function saveOffice($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }

    $this->name = $input['name'];
    $this->stat = $input['stat'];
    $this->addr = $input['addr'];
    $this->postal = $input['postal'];
    $this->company_id = $input['company_id'];
    $this->save();
    return true;
  }


  public function getValidation() {
    return $this->validation;
  }
}