<?php namespace App\Models;

use CommonHelper;
use Eloquent, DB, Validator, Input;

class Operator extends Eloquent
{
  public $table = 'user';
  protected $primaryKey = 'user_id';
  protected $validation;
  public $timestamps = false;

}