<?php namespace App\Models;

use Eloquent, DB, Validator, Log;

class Setting extends Eloquent
{
  public $table = 'setting';
  protected $primaryKey = 'setting_id';
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

  public function saveSetting($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }

    $this->name = $input['name'];
    $this->stat = $input['stat'];
    $this->save();
    return true;
  }

  public static function getSetting($name) {
    return Setting::where('name', $name)->value('value');
  }

  public static function getPaydollarSetting() {
    $settings = Setting::whereIn('name', ['paydollar_merchant_id', 'paydollar_post_url'])->pluck('value', 'name');
    $res['merchant_id'] = $settings['paydollar_merchant_id'];
    $res['post_url'] = $settings['paydollar_post_url'];
    return $res;
  }

  public function getValidation() {
    return $this->validation;
  }
}