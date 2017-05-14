<?php namespace App\Models;

use App\Models\Helpers\BackendHelper;
use Eloquent, DB, Validator, Log;

class FrontendBanner extends Eloquent
{
  public $table = 'frontend_banner';
  protected $primaryKey = 'frontend_banner_id';
  const CREATED_AT = 'created_on';
  const UPDATED_AT = 'updated_on';
  protected $validation;
  public $timestamps = false;

  private $rules = [
    'title'=>'required',
    'content'=>'required',
    'button_text'=>'required',
    'link'=>'required',
  ];

  private $messages = [
    'title.required'=>'Title is required',
    'content.required'=>'Content is required',
    'button_text.required'=>'Button text is required',
    'link.required'=>'Link is required',
  ];

  public function saveBanner($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }
  
    $this->title = $input['title'];
    $this->content = $input['content'];
    $this->button_text = $input['button_text'];
    $this->link = $input['link'];
    $this->save();
  
    if (isset($input['image'])) {
      $image_name = BackendHelper::uploadFile('images/frontend/banners/', 'banner_'.$this->frontend_banner_id, $input['image']);
      DB::table('frontend_banner')->where('frontend_banner_id', $this->frontend_banner_id)->update(['image'=>$image_name]);
    }
  
    return $this->frontend_banner_id;
  }


  public function getValidation() {
    return $this->validation;
  }

  public function getBannerAll()
  {
    return DB::table('frontend_banner')->get();
  }
}