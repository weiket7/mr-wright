<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Auth;
use Illuminate\Http\Request;
use App\Models\Product;

class BaseController extends Controller
{
  /*public function __construct()
  {
    $settings = Setting::pluck('value', 'name');
    view()->share('settings', $settings);
  }*/

  protected function getUsername() {
    return Auth::user()->username;
  }

}