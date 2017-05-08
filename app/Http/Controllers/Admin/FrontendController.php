<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FrontendBanner;
use App\Models\FrontendContent;
use App\Models\FrontendService;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
  public function content()
  {
    $frontend_content = new FrontendContent();
    $data['contents'] = $frontend_content->getContentAll();
    return view('admin/frontend/content-index', $data);
  }

  public function banner()
  {
    $frontend_content = new FrontendBanner();
    $data['banners'] = $frontend_content->getBannerAll();
    return view('admin/frontend/banner-index', $data);
  }

  public function service()
  {
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


}