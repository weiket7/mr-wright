<?php namespace App\Models;

use CommonHelper;
use Eloquent, DB, Validator, Input;

class Quotation extends Eloquent
{
  public $table = 'quotation';
  protected $primaryKey = 'quotation_id';
  protected $validation;
  public $timestamps = false;
  protected $fillable = ['ticket_id'];

  private $rules = [
    'name'=>'required',
  ];

  private $messages = [
    'name.required'=>'Name is required',
  ];

  public function saveQuotation($input) {
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