<?php namespace App\Models;

use App\Models\Helpers\BackendHelper;
use Eloquent, DB, Validator, Log;

class FrontendDynamic extends Eloquent
{
  public $table = 'frontend_dynamic';
  protected $primaryKey = 'frontend_dynamic_id';
  const CREATED_AT = 'created_on';
  const UPDATED_AT = 'updated_on';
  protected $validation;
  protected $attributes = ['stat'=>1, 'has_contact'=>1];
  public $timestamps = false;
  
  private $rules = [
    'title'=>'required',
    'url'=>'required',
  ];
  
  private $messages = [
    'title.required'=>'Title is required',
    'url.required'=>'URL is required',
  ];
  
  public function saveDynamic($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }
    
    $this->title = $input['title'];
    $this->stat = $input['stat'];
    $this->meta_title = $input['meta_title'];
    $this->meta_keyword = $input['meta_keyword'];
    $this->meta_desc = $input['meta_desc'];
    $this->content = $input['content'];
    $this->url = $input['url'];
    $this->has_contact = $input['has_contact'];
    $this->save();
    
    if (isset($input['image'])) {
      $image_name = BackendHelper::uploadFile('images/frontend/dynamics/', 'dynamic_'.$this->frontend_dynamic_id, $input['image']);
      DB::table('frontend_dynamic')->where('frontend_dynamic_id', $this->frontend_dynamic_id)->update(['image'=>$image_name]);
    }
    
    return $this->frontend_dynamic_id;
  }
  
  
  public function getValidation() {
    return $this->validation;
  }
  
  public function getBannerAll()
  {
    return DB::table('frontend_dynamic')->get();
  }
}