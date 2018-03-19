<?php namespace App\Models;

use App\Models\Enums\MembershipStat;
use App\Models\Enums\MembershipType;
use Eloquent, DB, Validator, Log;
use ViewHelper;

class Membership extends Eloquent
{
  public $table = 'membership';
  protected $primaryKey = 'membership_id';
  const CREATED_AT = 'created_on';
  const UPDATED_AT = 'updated_on';
  protected $validation;
  public $timestamps = false;
  
  public function getMembershipAll($stat = null, $with_details = false) {
    if ($stat) {
      $memberships = Membership::where('stat', $stat)->orderBy('position')->get();
    } else {
      $memberships = Membership::orderBy('position')->get();
    }
    foreach($memberships as $m) {
      if ($with_details) {
        $m->details = $this->getDetails($m->membership_id);
      }
    }
    return $memberships;
  }
  
  public function getMembershipDropdown($stat = null) {
    if ($stat) {
      $memberships = Membership::orderBy('position')->where('stat', $stat)->get();
    } else {
      $memberships = Membership::orderBy('position')->get();
    }
    return $memberships->pluck('full_name', 'membership_id');
  }
  
  private $rules = [
    'name'=>'required',
    'stat'=>'required',
    'requester_limit'=>'required|numeric',
    'effective_price'=>'required|numeric',
  ];
  
  private $messages = [
    'name.required'=>'Name is required',
    'stat.required'=>'Status is required',
    'requester_limit.required'=>'Number of requesters is required',
    'requester_limit.numeric'=>'Number of requesters must be numeric',
    'effective_price.required'=>'Price is required',
    'effective_price.numeric'=>'Price must be numeric',
  ];
  
  public function saveMembership($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }
    $free_trial = isset($input['free_trial']) ? true : false;
    if ($free_trial && $this->existingMembershipFreeTrial()) {
      $this->validation->errors()->add("free_trial", "An existing membership is free trial, disable that first");
      return false;
    }
    
    $this->name = $input['name'];
    $this->stat = $input['stat'];
    $this->type = $input['type'];
    $this->requester_limit = $input['requester_limit'];
    $this->free_trial = $free_trial;
    $this->effective_price = $input['effective_price'];
    $this->full_name = $this->name . ' - ' . $this->requester_limit .
      ' user'. ($this->requester_limit == 1 ? '' : 's') .
      ' at ' . ViewHelper::formatCurrency($this->effective_price) .
      ' / ' . ($this->type == MembershipType::Yearly ? 'year' : 'month');
    Log::info('full_name' . $this->full_name);
    $this->save();
    
    $this->saveMembershipDetails($input);
    return $this->membership_id;
  }
  
  
  public function getValidation() {
    return $this->validation;
  }
  
  public function saveMemberships($memberships, $input) {
    foreach($memberships as $pm) {
      $pm->position = $input['position'.$pm->membership_id];
      $pm->save();
    }
    return true;
  }
  
  private function existingMembershipFreeTrial()
  {
    return DB::table("membership")->where('free_trial', 1)->count() > 1;
  }
  
  public function getDetails($membership_id) {
    return DB::table('membership_detail')->where('membership_id', $membership_id)->orderBy('position')->get();
  }
  
  private function saveMembershipDetails($input) {
    DB::table('membership_detail')->where('membership_id', $this->membership_id)->delete();
    for($i=0; $i<$input['detail_count']; $i++) {
      DB::table('membership_detail')->insert([
        'membership_id'=>$this->membership_id,
        'position'=>$input['position'.$i],
        'content'=>$input['content'.$i]
      ]);
    }
  }
  
}