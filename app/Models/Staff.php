<?php namespace App\Models;

use Carbon\Carbon;
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
  
  public function saveStaff($input, $operator = 'admin') {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }

    $this->name = $input['name'];
    $this->save();
    
    $this->saveStaffSkills($input, $operator);
    return true;
  }
  
  private function saveStaffSkills($input, $operator = 'admin') {
    $count = $input['staff_skills_count'];
    for($i=0; $i<$count; $i++) {
      $stat = isset($input['staff_skill_stat'.$i]) ? $input['staff_skill_stat'.$i] : '';
      if ($stat == 'delete') {
        DB::table('staff_skill')->where('staff_skill_id', $input['skill_id'.$i])->delete();
        continue;
      }

      $skill_id = isset($input['staff_skill'.$i]) ? $input['staff_skill'.$i] : null;
      if ($skill_id) {
        $staff_skill = [
          'skill_id' =>$skill_id,
          'updated_by'=>$operator,
          'updated_on'=>Carbon::now()
        ];
        if ($stat == 'add') {
          $staff_skill['staff_id'] = $this->staff_id;
          DB::table('staff_skill')->insert($staff_skill);
        } else {
          $staff_skill_id = $input['staff_skill_id'.$i];
          DB::table('staff_skill')->where('staff_skill_id', $staff_skill_id)->update($staff_skill);
        }
      }
    }
  }

  public function getStaffSkills() {
    return DB::table('skill as sk')
      ->join('staff_skill as ss', 'ss.skill_id', '=', 'sk.skill_id')
      ->join('staff as st', 'ss.staff_id', '=', 'st.staff_id')
      ->where('ss.staff_id', $this->staff_id)->select('staff_skill_id', 'sk.skill_id', 'sk.name')->get();
  }

  public function getValidation() {
    return $this->validation;
  }
}