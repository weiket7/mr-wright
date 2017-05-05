<?php namespace App\Models;

use App\Models\Enums\StaffStat;
use Carbon\Carbon;

use Eloquent, DB, Validator, Log;

class Staff extends Eloquent
{
  public $table = 'staff';
  protected $primaryKey = 'staff_id';
  protected $validation;
  public $timestamps = false;
  protected $attributes = ['stat'=>StaffStat::Active];

  private $rules = [
    'name'=>'required',
    'stat'=>'required',
    'mobile'=>'required',
    'email'=>'required',
  ];

  private $messages = [
    'name.required'=>'Name is required',
    'stat.required'=>'Status is required',
    'mobile.required'=>'Mobile is required',
    'email.required'=>'Email is required',
  ];

  public static function getStaffAll()
  {
    $staffs = Staff::all();

    $data = DB::table('skill as sk')
      ->join('staff_skill as ss', 'ss.skill_id', '=', 'sk.skill_id')->select('ss.staff_id', 'ss.skill_id', 'sk.name')->get();
    $res = [];

    foreach($data as $d) {
      $res[$d->staff_id][] = $d->name;
    }
    foreach($staffs as $staff) {
      $staff->skills = isset($res[$staff->staff_id]) ? $res[$staff->staff_id] : [];
    }
    return $staffs;
  }


  public function saveStaff($input, $operator = 'admin') {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }
  
    $this->name = $input['name'];
    $this->stat = $input['stat'];
    $this->mobile = $input['mobile'];
    $this->email = $input['email'];
    $this->save();

    $this->saveStaffSkills($input, $operator);
    return true;
  }

  private function saveStaffSkills($input, $username = 'admin') {
    DB::table('staff_skill')->where('staff_id', $this->staff_id)->delete();
    foreach(json_decode($input['staff_skills']) as $a) {
      DB::table('staff_skill')->insert([
        'staff_id'=>$this->staff_id,
        'skill_id'=>$a->skill_id
      ]);
    }
  }

  public function getStaffSkills() {
    return DB::table('skill as sk')
      ->join('staff_skill as ss', 'ss.skill_id', '=', 'sk.skill_id')
      ->join('staff as st', 'ss.staff_id', '=', 'st.staff_id')
      ->where('ss.staff_id', $this->staff_id)->select('staff_skill_id', 'sk.skill_id', 'sk.name')->get()->keyBy('skill_id');
  }

  public function getAvailableSkills($staff_skills) {
    $all_skills = Skill::select(['name', 'skill_id'])->get()->keyBy('skill_id');
    $available_skills = $all_skills->diffKeys($staff_skills)->all();
    return $available_skills;
  }

  public function getValidation() {
    return $this->validation;
  }
}