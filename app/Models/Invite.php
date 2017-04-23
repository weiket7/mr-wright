<?php namespace App\Models;

use Eloquent, DB, Validator, Log;

class Invite extends Eloquent
{
  public $table = 'invite';
  protected $primaryKey = 'invite_id';
  protected $validation;

  public function getValidation() {
    return $this->validation;
  }


}