<?php namespace App\Models;

use Eloquent, DB, Validator, Log;

class FrontendService extends Eloquent
{
  public $table = 'frontend_service';
  protected $primaryKey = 'frontend_service_id';
  const CREATED_AT = 'created_on';
  const UPDATED_AT = 'updated_on';
  protected $validation;
  public $timestamps = false;

  private $rules = [
    'name'=>'required',
    'stat'=>'required',
  ];

  private $messages = [
    'name.required'=>'Name is required',
    'stat.required'=>'Status is required',
  ];

  public function saveFrontendService($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }

    $this->name = $input['name'];
    $this->stat = $input['stat'];
    $this->save();
    return true;
  }


  public function getValidation() {
    return $this->validation;
  }

  public function getServiceAll()
  {
    $data = DB::table('frontend_service')->orderBy('position')->get();
    $res = [];
    foreach($data as $d) {
      $res[$d->slug] = $d;
    }
    return $res;
  }
}