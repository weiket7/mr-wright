<?php namespace App\Models;

use Eloquent, DB, Validator, Log;

class PaymentMethod extends Eloquent
{
  public $table = 'payment_method';
  protected $primaryKey = 'payment_method_id';
  const UPDATED_AT = 'updated_on';

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

}