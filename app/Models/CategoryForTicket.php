<?php namespace App\Models;

use Eloquent, DB, Validator;

class CategoryForTicket extends Eloquent
{
  public $table = 'category_for_ticket';
  protected $primaryKey = 'category_for_ticket_id';
  protected $validation;
  public $timestamps = false;

  private $rules = [
    'name'=>'required',
  ];

  private $messages = [
    'name.required'=>'Name is required',
  ];

  public function saveCategoryForTicket($input) {
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