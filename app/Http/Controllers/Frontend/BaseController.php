<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend;
use Auth;
use Cache;
use Illuminate\Http\Request;

class BaseController extends Controller
{
  public function __construct()
  {
    if (! Cache::has("frontend_cache")) {
      $frontend_service = new Frontend();
      $frontend_cache = $frontend_service->getFrontend();
      Cache::put("frontend_cache", $frontend_cache, 1440);
    }
    view()->share("frontend_cache", Cache::get("frontend_cache"));
  }
}