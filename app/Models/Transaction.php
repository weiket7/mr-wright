<?php namespace App\Models;

use Eloquent, DB, Validator, Log;

class Transaction extends Eloquent
{
  public $table = 'transaction';
  protected $primaryKey = 'transaction_id';
  const CREATED_AT = 'created_on';
  const UPDATED_AT = 'updated_on';
  protected $validation;
}