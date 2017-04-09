<?php namespace App\Models;


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

  public function saveSkill($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }

    $this->name = $input['name'];
    $this->save();
    return true;
  }


  public function getValidation() {
    return $this->validation;
  }
  
  public function getSkillDropdown() {
    return Skill::pluck('name', 'skill_id');
  }

}