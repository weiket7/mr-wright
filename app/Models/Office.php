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
  
  public function searchOffice($input) {
    $s = "SELECT office_id, o.stat, o.name, c.name as company_name, o.addr, o.postal, o.requester_count
    from office as o
    inner join company as c on o.company_id = c.company_id
    where o.deleted_at is null ";
    if (isset($input['stat']) && $input['stat'] != '') {
      $s .= " and o.stat = '$input[stat]'";
    }
    if (isset($input['name']) && $input['name'] != '') {
      $s .= " and o.name like '%".$input['name']."%'";
    }
    if (isset($input['company_id']) && $input['company_id'] != '') {
      $s .= " and o.company_id =".$input['company_id'];
    }
    return DB::select($s);
  }
  
  public function deleteOffice() {
    $this->delete();
    
    Requester::where('office_id', $this->office_id)->delete();
  
    $company = new Registration();
    $company->updateCompanyOfficeRequesterCount($this->company_id);
  }

  public function getRequesterByOffice($office_id) {
    return Requester::where('office_id', $office_id)->get();
  }
  
  public static function getOfficeDropdown($company_id = null) {
    if($company_id == null) {
      return Office::pluck('name', 'company_id');
    }
    return Office::where('company_id', $company_id)->pluck('name', 'office_id');
  }
  
  public function getValidation() {
    return $this->validation;
  }
}