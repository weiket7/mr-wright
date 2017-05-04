<?php

namespace App\Http\Composers;

use App\Models\Enums\UserType;
use App\Models\FrontendBanner;
use App\Models\FrontendContent;
use App\Models\FrontendService;
use App\Models\Requester;
use Auth;
use Illuminate\View\View;
use Log;

class FrontendComposer
{
  public function compose(View $view) {
    $frontend_content = new FrontendContent();
    $data['contents'] = $frontend_content->getContentAll();
    $frontend_banner = new FrontendBanner();
    $data['banners'] =  $frontend_banner->getBannerAll();
    $frontend_service = new FrontendService();
    $data['services'] =  $frontend_service->getServiceAll();
    if (Auth::check() && Auth::user()->type == UserType::Requester) {
      $username = Auth::user()->username;
      Log::info($username);
      $data['logged_in_requester'] = Requester::where('username', $username)->first();
    }

    $view->with('frontend', $data);
  }

}