<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FrontendService;
use Illuminate\Http\Request;

class SiteController extends Controller
{
  public function index()
  {
    return view("frontend/index");
  }

  public function register()
  {
    return view("frontend/register");
  }

  public function about()
  {
    return view("frontend/about");
  }

  public function service($slug = null)
  {
    $frontend_service = new FrontendService();
    $data['services'] = $frontend_service->getServiceAll();
    if ($slug == null) {
      $data['current_service'] = array_first($data['services']);
    } else {
      $data['current_service'] = $data['services'][$slug];
    }
    return view("frontend/service", $data);

  }

  public function project()
  {
    return view("frontend/project");
  }

  public function contact()
  {
    return view("frontend/contact");
  }


}