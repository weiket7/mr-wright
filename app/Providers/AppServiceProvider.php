<?php

namespace App\Providers;

use App\Models\FrontendBanner;
use App\Models\FrontendContent;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    $frontend_content = new FrontendContent();
    $data['contents'] = $frontend_content->getContentAll();
    $frontend_banner = new FrontendBanner();
    $data['banners'] =  $frontend_banner->getBannerAll();
    view()->share('frontend', $data);
  }

  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }
}
