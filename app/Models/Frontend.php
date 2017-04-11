<?php namespace App\Models;

use Eloquent, DB, Validator, Log;

class Frontend extends Eloquent
{
  public $table = 'frontend';
  protected $primaryKey = 'frontend_id';
  public $timestamps = false;

  private $rules = [
    'name'=>'required',
    'stat'=>'required',
  ];

  private $messages = [
    'name.required'=>'Name is required',
    'stat.required'=>'Status is required',
  ];

  public function saveFrontend($input) {
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
  
  public function getFrontend()
  {
  }
}