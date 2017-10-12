<?php namespace App\Models;


use App\Models\Helpers\BackendHelper;
use Eloquent, DB, Validator, Log;

class Skill extends Eloquent
{
  public $table = 'skill';
  protected $primaryKey = 'skill_id';
  protected $validation;
  public $timestamps = false;

  private $rules = [
    'name'=>'required',
  ];

  private $messages = [
    'name.required'=>'Name is required',
  ];

  public function saveSkill($input, $image) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }
  
    $this->name = $input['name'];
    $this->desc = $input['desc'];
    
    if ($image) {
      $this->image = BackendHelper::uploadFile('images', str_slug($this->name), $image);
    }
  
    $this->save();
    return true;
  }
  
  public function deleteStaffSkillBySkill($skill_id) {
    DB::table('staff_skill')->where('skill_id', $skill_id)->delete();
  }

  public function getValidation() {
    return $this->validation;
  }
  
  public function getSkillDropdown() {
    return Skill::pluck('name', 'skill_id');
  }

}