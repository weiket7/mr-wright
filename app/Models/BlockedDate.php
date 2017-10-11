<?php namespace App\Models;

use Carbon\Carbon;
use Eloquent, DB, Validator, Log;

class BlockedDate extends Eloquent
{
  public $table = 'working_date_blocked';
  protected $primaryKey = 'working_date_blocked_id';
  protected $validation;
  public $timestamps = false;
  
  private $rules = [
    'date'=>'required',
  ];
  
  private $messages = [
    'date.required'=>'Name is required',
  ];
  
  public function saveBlockedDate($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }
    
    $this->date = Carbon::createFromFormat('d M Y', $input['date']);
    $this->save();
    return true;
  }
  
  
  public function getValidation() {
    return $this->validation;
  }
}