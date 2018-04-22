<?php namespace App\Models;

use App\Models\Helpers\BackendHelper;
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
    'title'=>'required',
    'content'=>'required',
  ];

  private $messages = [
    'title.required'=>'Title is required',
    'content.required'=>'Content is required',
  ];
  
  public function saveService($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }
    
    $this->title = $input['title'];
    $this->content = $input['content'];
    $this->url = $input['url'];
    $this->meta_title = $input['meta_title'];
    $this->meta_keyword = $input['meta_keyword'];
    $this->meta_desc = $input['meta_desc'];
    $this->save();
  
    if (isset($input['image1'])) {
      $image_name = BackendHelper::uploadFile('images/frontend/services/', 'service-'.$this->frontend_service_id.'-1', $input['image1']);
      DB::table('frontend_service')->where('frontend_service_id', $this->frontend_service_id)->update(['image1'=>$image_name]);
    }
    if (isset($input['image2'])) {
      $image_name = BackendHelper::uploadFile('images/frontend/services/', 'service-'.$this->frontend_service_id.'-2', $input['image2']);
      DB::table('frontend_service')->where('frontend_service_id', $this->frontend_service_id)->update(['image2'=>$image_name]);
    }
    
    return $this->frontend_service_id;
  }

  public function getValidation() {
    return $this->validation;
  }

  public function getServiceAll()
  {
    $data = DB::table('frontend_service')->orderBy('position')->get();
    return $data;
  }
}