<?php namespace App\Models;

use Eloquent, DB, Validator, Log;

class PaymentMethod extends Eloquent
{
  public $table = 'payment_method';
  protected $primaryKey = 'payment_method_id';
  const UPDATED_AT = 'updated_on';
  const CREDIT_CARD = 'R';

  public function savePaymentMethod($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }

    $this->name = $input['name'];
    $this->stat = $input['stat'];
    $this->save();
    return true;
  }
  
  public function savePaymentMethods($payment_methods, $input)
  {
    foreach($payment_methods as $pm) {
      $pm->position = $input['position'.$pm->payment_method_id];
      $pm->stat = $input['stat'.$pm->payment_method_id];
      $pm->save();
    }
    return true;
  }
  
}