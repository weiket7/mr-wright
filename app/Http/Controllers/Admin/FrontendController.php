<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FrontendBanner;
use App\Models\FrontendContent;
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


}