<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

class SiteController extends BaseController
{
  public function index()
  {
    return view("frontend/index");
  }

  public function register()
  {
    return view("frontend/register");
  }

  public function contact()
  {
    return view("frontend/contact");
  }


}