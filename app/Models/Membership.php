<?php namespace App\Models;

use Eloquent, DB, Validator, Log;

class Membership extends Eloquent
{
  public $table = 'membership';
  protected $primaryKey = 'membership_id';
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
  
  public function saveMembership($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }
    
    $this->name = $input['name'];
    $this->stat = $input['stat'];
    $this->save();
    return $this->membership_id;
  }
  
  
  public function getValidation() {
    return $this->validation;
  }
}