<?php namespace App\Models;


use Eloquent, DB, Validator, Log;

class Ticket extends Eloquent
{
  public $table = 'ticket';
  protected $primaryKey = 'ticket_id';
  protected $validation;
  public $timestamps = false;
  
  private $rules = [
    'name'=>'required',
  ];
  
  private $messages = [
    'name.required'=>'Name is required',
  ];
  
  public function saveTemplate($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }
    
    $this->name = $input['name'];
    $this->save();
    return true;
  }
  
  
  public function getValidation() {
    return $this->validation;
  }
}