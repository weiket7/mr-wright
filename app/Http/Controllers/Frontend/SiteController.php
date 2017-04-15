<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Enums\UserType;
use App\Models\FrontendService;
use App\Models\Register;
use App\Models\Requester;
use Auth;
use Illuminate\Http\Request;
use Log;

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
      return redirect()->back()->with('login_error', 'Wrong username/password');
    }

    return view("frontend/login");
  }

  public function account(Request $request) {
    $requester_service = new Requester();
    $data['user'] = $requester_service->getRequesterByUsername($this->getUsername());
    return view('frontend/account', $data);
  }

  public function logout(Request $request)
  {
    Auth::logout();
    return redirect("login")->with('msg', 'Logged out');
  }

  public function register(Request $request)
  {
    if ($request->isMethod("post")) {
      $register = new Register();
      $input = $request->all();
      $user_id = $register->saveRegister($input);
      if (! $user_id) {
        return redirect()->back()->withErrors($register->getValidation())->withInput($input);
      }
      Auth::loginUsingId($user_id);
      return redirect('account')->with('msg', 'Welcome to Mr Wright, would you like to start by <a href='.url('ticket/save').'>creating a ticket</a>?');
    }
    return view("frontend/register");
  }

  public function about(Request $request)
  {
    return view("frontend/about");
  }

  public function service(Request $request, $slug = null)
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

  public function project(Request $request)
  {
    return view("frontend/project");
  }

  public function contact(Request $request)
  {
    return view("frontend/contact");
  }


}