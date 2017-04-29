<?php namespace App\Models;

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
  
  public function getMembershipAll($stat = null) {
    if ($stat) {
      $memberships = Membership::orderBy('position')->where('stat', $stat)->get();
    } else {
      $memberships = Membership::orderBy('position')->get();
    }
    foreach($memberships as $m) {
      $m->full_name = $m->title . ' - ' . $m->requester_limit . ' at ' . $m->effective_price . ' / month';
    }
    return $memberships;
  }
  
  public function getMembershipDropdown($stat = null) {
    if ($stat) {
      $memberships = Membership::orderBy('position')->where('stat', $stat)->get();
    } else {
      $memberships = Membership::orderBy('position')->get();
    }
    foreach($memberships as $m) {
      $m->full_name = $m->name . ' - ' . $m->requester_limit . ' user'. ($m->requester_limit == 1 ? '' : 's') . ' at ' . ViewHelper::formatCurrency($m->effective_price) . ' / month';
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