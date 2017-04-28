<?php namespace App\Models;

use Eloquent, DB, Validator, Log;

class Membership extends Eloquent
{
  public $table = 'membership';
  protected $primaryKey = 'membership_id';
  const CREATED_AT = 'created_on';
  const UPDATED_AT = 'updated_on';
  protected $validation;
  public $timestamps = false;
  
  public function getMembershipAll() {
    return Membership::orderBy('position')->get();
  }
  
  public function getMembershipDropdown($stat = null) {
    $memberships = Membership::orderBy('position');
    if ($stat) {
      $memberships->where('stat', $stat);
    }
    return $memberships->pluck('name', 'membership_id');
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
    
    $this->name = $input['name'];
    $this->stat = $input['stat'];
    $this->requester_limit = $input['requester_limit'];
    $this->effective_price = $input['effective_price'];
    $this->save();
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
}