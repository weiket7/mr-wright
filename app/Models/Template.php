<?php namespace App\Models;

use Eloquent, DB, Validator, Log;

class Template extends Eloquent
{
  public $table = 'template';
  protected $primaryKey = 'template_id';
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

  public function saveTemplate($input) {
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