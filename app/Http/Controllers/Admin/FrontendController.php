<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FrontendBanner;
use App\Models\FrontendContent;
use App\Models\FrontendService;
use Illuminate\Http\Request;
use Log;

class FrontendController extends Controller
{
  public function content()   {
    $frontend_content = new FrontendContent();
    $data['contents'] = $frontend_content->getContentAll();
    return view('admin/frontend/content-index', $data);
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

  public function contentSave(Request $request, $key) {
    $frontend_content = new FrontendContent();
    if ($request->isMethod('post')) {
      $frontend_content->saveContent($key, $request->get('value'));
      return redirect("admin/frontend/content/save/".$key)->with("msg", "Content updated");
    }

    $data['key'] = $key;
    $data['value'] = $frontend_content->getContent($key);
    return view('admin/frontend/content-form', $data);
  }
  
  public function serviceSave(Request $request, $service_id) {
    $service = $service_id == null ? new FrontendService() : FrontendService::find($service_id);
    $action = $service_id == null ? 'create' : 'update';
    if ($request->isMethod('post')) {
      $input = $request->all();
      if (! $service->saveService($input)) {
        return redirect()->back()->withErrors($service->getValidation())->withInput($input);
      }
      return redirect("admin/frontend/service/save/".$service_id)->with("msg", "Service " . $action . "d");
    }
    $data['action'] = $action;
    $data['service'] = $service;
    return view('admin/frontend/service-form', $data);
  }


}