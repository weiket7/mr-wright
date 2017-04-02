<?php namespace App\Models;


use App\Models\Enums\OfficeStat;
use Eloquent, DB, Validator, Log;

class Office extends Eloquent
{
  public $table = 'office';
  protected $primaryKey = 'office_id';
  const CREATED_AT = 'created_on';
  const UPDATED_AT = 'updated_on';
  protected $validation;
  public $timestamps = false;
  protected $attributes = ['stat'=>OfficeStat::Active];


  private $rules = [
    'name'=>'required',
    'addr'=>'required',
    'postal'=>'required',
    'company_id'=>'required',
    'stat'=>'required',
  ];

  private $messages = [
    'name.required'=>'Name is required',
    'addr.required'=>'Address is required',
    'postal.required'=>'Postal is required',
    'company_id.required'=>'Company is required',
    'stat.required'=>'Status is required',
  ];

  public function saveOffice($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }

    $this->name = $input['name'];
    $this->stat = $input['stat'];
    $this->addr = $input['addr'];
    $this->postal = $input['postal'];
    $this->company_id = $input['company_id'];
    $this->save();
    return true;
  }


  public function getValidation() {
    return $this->validation;
  }
}