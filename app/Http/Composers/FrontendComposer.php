<?php

namespace App\Http\Composers;

use App\Models\FrontendBanner;
use App\Models\FrontendContent;
use App\Models\FrontendService;
use Illuminate\View\View;

class FrontendComposer
{
  public function compose(View $view) {
    $frontend_content = new FrontendContent();
    $data['contents'] = $frontend_content->getContentAll();
    $frontend_banner = new FrontendBanner();
    $data['banners'] =  $frontend_banner->getBannerAll();
    $frontend_service = new FrontendService();
    $data['services'] =  $frontend_service->getServiceAll();

    $view->with('frontend', $data);
  }

}