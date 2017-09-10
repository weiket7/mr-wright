<?php namespace App\Models;

use Carbon\Carbon;
use Eloquent, DB, Validator, Log;

class Registration extends Eloquent
{
  public $table = 'registration';
  protected $primaryKey = 'registration_id';
  protected $validation;
  const CREATED_AT = 'created_on';
  const UPDATED_AT = 'updated_on';

  private $rules = [
    'name'=>'required',
    'stat'=>'required',
  ];

  private $messages = [
    'name.required'=>'Name is required',
    'stat.required'=>'Status is required',
  ];


  public function getValidation() {
    return $this->validation;
  }

  public function searchRegistration($input) {
    $s = "SELECT * from registration
    where 1 ";
    if (isset($input['stat'])) {
      if (is_array($input['stat']) && count($input['stat'])) {
        $s .= " and stat in ('".implode(',', $input['stat'])."')";
      } elseif ($input['stat'] != '') {
        $s .= " and stat = '".$input['stat']."'";
      }
    }

    if (isset($input['company_name']) && $input['company_name'] != '') {
      $s .= " and company_name like '%".$input['company_name']."%'";
    }
    if (isset($input['uen']) && $input['uen'] != '') {
      $s .= " and uen = '".$input['ticket_code']."'";
    }

    if (isset($input['date_from']) && isset($input['date_to'])
      && $input['date_from'] != '' && $input['date_to'] != '') {
      $date_from = Carbon::createFromFormat('d M Y', $input['date_from']);
      $date_to = Carbon::createFromFormat('d M Y', $input['date_to'])->addDay(1)->format('Y-m-d');
      $s .= " and (created_on >= '".$date_from."' and created_on < '".$date_to."')";
    }
    
    $s .= " order by created_on desc";
    if (isset($input['limit']) && $input['limit'] > 0) {
      $s .= " limit ".$input['limit'];
    }
    return DB::select($s);
  }

}