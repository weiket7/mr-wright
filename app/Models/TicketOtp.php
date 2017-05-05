<?php namespace App\Models;

use Eloquent, DB, Validator, Log;

class TicketOtp extends Eloquent
{
  public $table = 'ticket_otp';
  protected $primaryKey = 'ticket_otp_id';
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
  
  public function saveTicketOtp($input) {
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