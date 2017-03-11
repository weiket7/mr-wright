<?php namespace App\Models;

use CommonHelper;
use Eloquent, DB, Validator, Input;

class Staff extends Eloquent
{
  public $table = 'staff';
  protected $primaryKey = 'staff_id';
  protected $validation;
  public $timestamps = false;

  private $rules = [
    'name'=>'required',
  ];

  private $messages = [
    'name.required'=>'Name is required',
  ];

  public function saveStaff($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }

    $this->name = $input['name'];
    $this->save();
    return true;
  }

  public function getSkills($staff_id) {
    return DB::table('skill as sk')
      ->join('staff_skill as ss', 'ss.skill_id', '=', 'sk.skill_id')
      ->join('staff as st', 'ss.staff_id', '=', 'st.staff_id')
      ->where('ss.staff_id', $staff_id)->select('sk.skill_id', 'sk.name')->get();
  }

  public function getValidation() {
    return $this->validation;
  }
}