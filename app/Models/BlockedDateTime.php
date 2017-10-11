<?php namespace App\Models;

use Carbon\Carbon;
use Eloquent, DB, Validator, Log;

class BlockedDateTime extends Eloquent
{
  public $table = 'working_date_time_blocked';
  protected $primaryKey = 'working_date_time_blocked_id';
  protected $validation;
  public $timestamps = false;
  
  private $rules = [
    'date'=>'required',
  ];
  
  private $messages = [
    'date.required'=>'Date is required',
  ];
  
  public function saveBlockedDateTime($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }
  
    $this->date = Carbon::createFromFormat('d M Y', $input['date']);
    $this->time_start = $input['time_start'];
    $this->time_end = $input['time_end'];
    $this->save();
    return true;
  }
  
  
  public function getValidation() {
    return $this->validation;
  }
}