<?php namespace App\Models;

use App\Models\Enums\CompanyStat;
use Eloquent, DB, Validator;

class Company extends Eloquent
{
  public $table = 'company';
  protected $primaryKey = 'company_id';
  protected $validation;
  public $timestamps = false;
  protected $attributes = ['stat'=>CompanyStat::Active];

  private $rules = [
    'name'=>'required',
    'code'=>'required|unique:company,code'
  ];
  
  private $messages = [
    'name.required'=>'Name is required',
    'code.required'=>'Code is required',
    'code.unique'=>'Code is not available'
  ];
  
  public function saveCompany($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }

    $this->name = $input['name'];
    if(isset($input['code'])) {
      $this->code = $input['code'];
    }
    $this->registered_name = $input['registered_name'];
    $this->stat = $input['stat'];
    $this->addr = $input['addr'];
    $this->country = $input['country'];
    $this->state = $input['state'];
    $this->city = $input['city'];
    $this->postal = $input['postal'];
    $this->industry = $input['industry'];
    $this->save();
    return true;
  }

  public function getOffices($company_id) {
    return DB::table('office')
      ->where('company_id', $company_id)
      ->select('office_id', 'name')->get();
  }
  
  public function getValidation() {
    return $this->validation;
  }
}