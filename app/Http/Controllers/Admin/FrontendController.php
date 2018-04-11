<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeleteLog;
use App\Models\FrontendBanner;
use App\Models\FrontendBlog;
use App\Models\FrontendContent;
use App\Models\FrontendDynamic;
use App\Models\FrontendFile;
use App\Models\FrontendService;
use Cache;
use Illuminate\Http\Request;
use Log;

class FrontendController extends Controller
{
  public function content()   {
    $frontend_content = new FrontendContent();
    $data['contents'] = $frontend_content->getContentAll();
    return view('admin/frontend/content-index', $data);
  }
  
  public function contentSave(Request $request, $key) {
    $frontend_content = new FrontendContent();
    $content = $frontend_content->getContent($key);
    if ($request->isMethod('post')) {
      $frontend_content->saveContent($key, $request->all(), $content->is_image);
      Cache::flush();
      return redirect("admin/frontend/content/save/".$key)->with("msg", "Content updated");
    }
    
    $data['key'] = $key;
    $data['content'] = $frontend_content->getContent($key);
    return view('admin/frontend/content-form', $data);
  }
  
  public function fileSave(Request $request, $key) {
    $frontend_file = FrontendFile::where('key', $key)->first();
    if ($request->isMethod('post')) {
      $frontend_file->saveFrontendFile($request->all());
      Cache::flush();
      return redirect("admin/frontend/file/save/".$frontend_file->key)->with("msg", "File uploaded");
    }
    
    $data['key'] = $key;
    $data['frontend_file'] = $frontend_file;
    return view('admin/frontend/file', $data);
  }
  
  public function banner()   {
    $frontend_content = new FrontendBanner();
    $data['banners'] = $frontend_content->getBannerAll();
    return view('admin/frontend/banner-index', $data);
  }
  
  public function bannerSave(Request $request, $banner_id) {
    $banner = $banner_id == null ? new FrontendBanner() : FrontendBanner::find($banner_id);
    $action = $banner_id == null ? 'create' : 'update';
    if ($request->isMethod('post')) {
      $input = $request->all();
      if (! $banner->saveBanner($input)) {
        return redirect()->back()->withErrors($banner->getValidation())->withInput($input);
      }
      Cache::flush();
      return redirect("admin/frontend/banner/save/".$banner_id)->with("msg", "Banner " . $action . "d");
    }
    $data['action'] = $action;
    $data['banner'] = $banner;
    return view('admin/frontend/banner-form', $data);
  }

  public function service()   {
    $frontend_content = new FrontendService();
    $data['services'] = $frontend_content->getServiceAll();
    return view('admin/frontend/service-index', $data);
  }

  public function serviceSave(Request $request, $service_id) {
    $service = $service_id == null ? new FrontendService() : FrontendService::find($service_id);
    $action = $service_id == null ? 'create' : 'update';
    if ($request->isMethod('post')) {
      $input = $request->all();
      if (! $service->saveService($input)) {
        return redirect()->back()->withErrors($service->getValidation())->withInput($input);
      }
      Cache::flush();
      return redirect("admin/frontend/service/save/".$service_id)->with("msg", "Service " . $action . "d");
    }
    $data['action'] = $action;
    $data['service'] = $service;
    return view('admin/frontend/service-form', $data);
  }
  
  public function dynamic()   {
    $data['dynamics'] = FrontendDynamic::all();
    return view('admin/frontend/dynamic-index', $data);
  }
  
  public function dynamicSave(Request $request, $dynamic_id = null) {
    $dynamic = $dynamic_id == null ? new FrontendDynamic() : FrontendDynamic::find($dynamic_id);
    $action = $dynamic_id == null ? 'create' : 'update';
    if ($request->isMethod('post')) {
      $input = $request->all();
      if ($input["delete"] == "true") {
        (new DeleteLog())->saveDeleteLog('dynamic', $dynamic_id, $dynamic->title, $this->getUsername());
        $dynamic->delete();
        return redirect("admin/frontend/dynamic")->with("msg", "Dynamic deleted");
      }
      
      $dynamic_id = $dynamic->saveDynamic($input);
      if (! $dynamic_id) {
        return redirect()->back()->withErrors($dynamic->getValidation())->withInput($input);
      }
      return redirect("admin/frontend/dynamic/save/".$dynamic_id)->with("msg", "Dynamic " . $action . "d");
    }
    $data['action'] = $action;
    $data['dynamic'] = $dynamic;
    return view('admin/frontend/dynamic-form', $data);
  }
  
  public function blog()   {
    $data['blogs'] = FrontendBlog::all();
    return view('admin/frontend/blog-index', $data);
  }
  
  public function blogSave(Request $request, $blog_id = null) {
    $blog = $blog_id == null ? new FrontendBlog() : FrontendBlog::find($blog_id);
    $action = $blog_id == null ? 'create' : 'update';
    if ($request->isMethod('post')) {
      $input = $request->all();
      if ($input["delete"] == "true") {
        (new DeleteLog())->saveDeleteLog('blog', $blog_id, $blog->title, $this->getUsername());
        $blog->delete();
        return redirect("admin/frontend/blog")->with("msg", "Blog deleted");
      }
      
      $blog_id = $blog->saveBlog($input);
      if (! $blog_id) {
        return redirect()->back()->withErrors($blog->getValidation())->withInput($input);
      }
      return redirect("admin/frontend/blog/save/".$blog_id)->with("msg", "Blog " . $action . "d");
    }
    $data['action'] = $action;
    $data['blog'] = $blog;
    return view('admin/frontend/blog-form', $data);
  }
  
}