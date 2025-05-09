<?php namespace App\Models;

use App\Models\Helpers\BackendHelper;
use Carbon\Carbon;
use Eloquent, DB, Validator, Log;

class FrontendBlog extends Eloquent
{
  public $table = 'frontend_blog';
  protected $primaryKey = 'frontend_blog_id';
  const CREATED_AT = 'created_on';
  const UPDATED_AT = 'updated_on';
  protected $validation;
  protected $attributes = ['stat'=>1];
  public $timestamps = false;
  
  private $rules = [
    'title'=>'required',
  ];
  
  private $messages = [
    'title.required'=>'Title is required',
  ];
  
  public function saveBlog($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }
    
    $this->title = $input['title'];
    $this->slug = str_slug($input['title']);
    $this->stat = $input['stat'];
    $this->meta_title = $input['meta_title'];
    $this->meta_keyword = $input['meta_keyword'];
    $this->meta_desc = $input['meta_desc'];
    $this->desc = $input['desc'];
    $this->content = $input['content'];
    $this->posted_on = Carbon::now();
    $this->save();
    
    if (isset($input['image'])) {
      $image_name = BackendHelper::uploadFile('images/frontend/blogs/', 'blog_'.$this->frontend_blog_id, $input['image']);
      DB::table('frontend_blog')->where('frontend_blog_id', $this->frontend_blog_id)->update(['image'=>$image_name]);
    }
    
    return $this->frontend_blog_id;
  }
  
  public function getValidation() {
    return $this->validation;
  }
  
}