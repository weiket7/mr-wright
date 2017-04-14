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
    view()->composer('*', 'App\Http\Composers\FrontendComposer');
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
