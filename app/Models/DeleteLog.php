<?php namespace App\Models;

use Carbon\Carbon;
use Eloquent, DB, Validator, Log;

class DeleteLog extends Eloquent
{
  public $table = 'delete_log';
  protected $primaryKey = 'delete_log_id';
  protected $validation;
  public $timestamps = false;
  
  public function saveDeleteLog($table_name, $id, $desc, $username) {
    DB::table('delete_log')->insert([
      'table_name'=>$table_name,
      'id'=>$id,
      'desc'=>$desc,
      'deleted_by'=>$username,
      'deleted_on'=>Carbon::now()
    ]);
  }
  
}