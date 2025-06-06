<?php namespace App\Models;

use App\Models\Helpers\BackendHelper;
use Eloquent, DB, Validator, Log;

class FrontendContent extends Eloquent
{
  public $table = 'frontend_content';
  protected $primaryKey = 'frontend_content_id';
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

  public function saveFrontendContent($input) {
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

  public function getContentAll()
  {
    return DB::table('frontend_content')->pluck('value', 'key');
  }

  public function getContent($key) {
    return DB::table('frontend_content')->where('key', $key)->first();
  }

  public function getBanner($key) {
    return DB::table('frontend_banner')->where('key', $key)->first();
  }

  public function getService($key) {
    return DB::table('frontend_service')->where('key', $key)->first();
  }

  public function saveContent($key, $input, $is_image) {
    if ($is_image) {
      if (isset($input['value'])) {
        $dir = "images/frontend";
        $image_name = BackendHelper::uploadFile($dir, $key, $input['value']);
        DB::table('frontend_content')->where('key', $key)->update(['value'=>$image_name]);
      }
    } else {
      DB::table('frontend_content')->where('key', $key)->update(['value'=>$input['value']]);
    }
  }
}