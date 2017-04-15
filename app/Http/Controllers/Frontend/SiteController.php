<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Enums\UserType;
use App\Models\FrontendService;
use Auth;
use Illuminate\Http\Request;

class SiteController extends Controller
{
  public function index()
  {
    return view("frontend/index");
  }

  public function login(Request $request)
  {
    $input = $request->all();
    if ($request->isMethod("post")) {
      if (Auth::attempt(['username'=>$input['username'], 'password'=>$input['password'], 'type'=>UserType::Requester])) {
        return redirect('account')->with('msg', 'You have logged in');
      }
      return redirect()->back()->with('msg', 'Wrong username/password');
    }

    return view("frontend/login");
  }

  public function account() {
    $data['user'] = Auth::user();
    return view('frontend/account', $data);
  }

  public function logout()
  {
    Auth::logout();
    return redirect("login")->with('msg', 'Logged out');
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