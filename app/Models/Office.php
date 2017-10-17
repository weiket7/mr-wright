<?php namespace App\Models;


use App\Models\Enums\OfficeStat;
use Eloquent, DB, Validator, Log;
use Illuminate\Database\Eloquent\SoftDeletes;

class Office extends Eloquent
{
  public $table = 'office';
  protected $primaryKey = 'office_id';
  protected $validation;
  public $timestamps = false;
  protected $attributes = ['stat'=>OfficeStat::Active];
  use SoftDeletes;

  private $rules = [
    'name'=>'required',
    'addr'=>'required',
    'postal'=>'required',
    'company_id'=>'sometimes|required',
    'stat'=>'sometimes|required',
  ];

  private $messages = [
    'name.required'=>'Name is required',
    'addr.required'=>'Address is required',
    'postal.required'=>'Postal is required',
    'company_id.required'=>'Company is required',
    'stat.required'=>'Status is required',
  ];

  public function saveOffice($input, $username) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }

    $this->name = $input['name'];
    $this->stat = $input['stat'];
    $this->company_id = $input['company_id'];
    $this->addr = $input['addr'];
    $this->postal = $input['postal'];
    $this->updated_by = $username;
    $this->save();
    return true;
  }

  public function saveOfficeFrontEnd($input, $username, $company_id) {
    $rules = [
      'name'=>'required',
      'addr'=>'required',
      'postal'=>'required',
    ];

    $messages = [
      'name.required'=>'Name is required',
      'addr.required'=>'Address is required',
      'postal.required'=>'Postal is required',
    ];

    $this->validation = Validator::make($input, $rules, $messages );
    if ( $this->validation->fails() ) {
      return false;
    }

    if ($this->office_id == null) { //create
      $this->company_id = $company_id;
      $this->stat = OfficeStat::Active;
    }
    $this->name = $input['name'];
    $this->addr = $input['addr'];
    $this->postal = $input['postal'];
    $this->updated_by = $username;
    $this->save();
    return true;
  }
  
  public function deleteOffice() {
    $this->delete();
    
    Requester::where('office_id', $this->office_id)->delete();
  
    $company = new Account();
    $company->updateCompanyOfficeRequesterCount($this->company_id);
  }

  public function getValidation() {
    return $this->validation;
  }
}