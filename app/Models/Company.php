<?php namespace App\Models;

use App\Models\Enums\CompanyStat;
use App\Models\Enums\MembershipType;
use Carbon\Carbon;
use Eloquent, DB, Validator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Company extends Eloquent
{
  public $table = 'company';
  protected $primaryKey = 'company_id';
  protected $validation;
  public $timestamps = false;
  protected $attributes = ['stat'=>CompanyStat::Active];
  use SoftDeletes;

  private $messages = [
    'name.required'=>'Name is required',
    'code.required'=>'Code is required',
    'registered_name.required'=>'Registered name is required',
    'stat.required'=>'Status is required',
    'addr.required'=>'Address is required',
    'postal.required'=>'Postal is required',
    'membership_id.required'=>'Membership plan is required',
    'code.unique'=>'Code is not available'
  ];
  
  public function saveCompany($input) {
    $rules = [
      'name' => 'required',
      'code' => ['required',
        Rule::unique('company')->ignore($this->code, 'code')
      ],
      'registered_name' => 'required',
      'stat' => 'required',
      'addr' => 'required',
      'postal' => 'required',
      'membership_id' => 'required',
    ];
    $this->validation = Validator::make($input, $rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }
  
    $this->name = $input['name'];
    $this->code = $input['code'];
    if(isset($input['uen'])) {
      $this->uen = $input['uen'];
    }
    
    $this->registered_name = $input['registered_name'];
    $this->stat = $input['stat'];
    $this->addr = $input['addr'];
    $this->country = $input['country'];
    $this->postal = $input['postal'];
    $this->industry = $input['industry'];
    $this->membership_id = $input['membership_id'];
    if($this->membership_type != MembershipType::Unlimited) {
      $this->membership_valid_till = Carbon::createFromFormat('d M Y', $input['membership_valid_till']);
    }
    $membership = Membership::find($this->membership_id);
    $this->requester_limit = $membership->requester_limit;
    $this->save();
    return true;
  }

  public function getOffices($company_id) {
    return Office::where('company_id', $company_id)
      ->select('office_id', 'name')->get();
  }
  
  public function deleteCompany() {
    $this->requester_count = 0;
    $this->save();
    $this->delete();
  
    Office::where('company_id', $this->company_id)->update(['requester_count'=>0]);
    Office::where('company_id', $this->company_id)->delete();
    
    Requester::where('company_id', $this->company_id)->delete();
  }
  
  public function searchCompany($input) {
    $s = "SELECT company_id, code, stat, name, requester_count
    from company
    where deleted_at is null ";
    if (isset($input['stat']) && $input['stat'] != '') {
      $s .= " and stat = '$input[stat]'";
    }
    if (isset($input['code']) && $input['code'] != '') {
      $s .= " and code like '%".$input['code']."%'";
    }
    if (isset($input['name']) && $input['name'] != '') {
      $s .= " and name like '%".$input['name']."%'";
    }
    return DB::select($s);
  }
  
  public function getRequesterByCompany($company_id) {
    return DB::table('requester as r')
      ->join('office as o', 'o.office_id', '=', 'r.office_id')
      ->join('company as c', 'c.company_id', '=', 'r.company_id')
      ->where('r.company_id', $company_id)
      ->select('requester_id', 'r.name', 'r.stat', 'r.type', 'r.company_id', 'r.office_id', 'c.name as company_name', 'o.name as office_name')
      ->orderBy('o.name')->orderBy('r.name')->get();
  }
  
  public static function getCompanyDropdown() {
    return Company::orderBy('name')->pluck('name', 'company_id');
  }
  
  public function getValidation() {
    return $this->validation;
  }
}