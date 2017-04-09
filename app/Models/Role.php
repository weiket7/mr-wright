<?php namespace App\Models;

use Eloquent, DB, Validator, Log;

class Role extends Eloquent
{
  public $table = 'role';
  protected $primaryKey = 'role_id';
  const CREATED_AT = 'created_on';
  const UPDATED_AT = 'updated_on';
  protected $validation;
  public $timestamps = false;

  private $rules = [
    'name'=>'required|sometimes',
  ];

  private $messages = [
    'name.required'=>'Name is required',
  ];

  public function saveRole($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }

    if (isset($input['name'])) {
      $this->name = $input['name'];
    }
    $this->save();

    $this->saveRoleAccesses($input);
    return true;
  }

  private function saveRoleAccesses($input) {
    DB::table('role_access')->where('role_id', $this->role_id)->delete();
    foreach(json_decode($input['role_accesses']) as $a) {
      DB::table('role_access')->insert([
        'role_id'=>$this->role_id,
        'access_id'=>$a->access_id
      ]);
    }
  }

  public function getValidation() {
    return $this->validation;
  }

  public function getRoleDropdown() {
    return Role::orderBy('name')->pluck('name', 'role_id');
  }
}