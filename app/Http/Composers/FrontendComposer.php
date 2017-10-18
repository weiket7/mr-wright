<?php

namespace App\Http\Composers;

use App\Models\Company;
use App\Models\Enums\UserType;
use App\Models\FrontendBanner;
use App\Models\FrontendContent;
use App\Models\FrontendService;
use App\Models\Requester;
use Auth;
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
    if (Auth::check() && Auth::user()->type == UserType::Requester) {
      $username = Auth::user()->username;
      $requester = Requester::where('username', $username)->first();
      $requester->free_trial = Company::where('company_id', $requester->company_id)->value('free_trial') == 1;
      $data['logged_in_requester'] = $requester;
    }

    $view->with('frontend', $data);
  }

}