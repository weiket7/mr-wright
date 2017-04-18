<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Jobs\TicketQuotationEmail;
use App\Models\Enums\RequesterStat;
use App\Models\Enums\UserType;
use App\Models\FrontendService;
use App\Models\Account;
use App\Models\Requester;
use App\Models\Services\CompanyService;
use Auth;
use Hash;
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
      $account_service  = new Account();
      $requester = $account_service->getRequesterForLogin($input['username']);
      if ($requester == null
        || ! Hash::check($input['password'], $requester->password)
        || $requester->stat == RequesterStat::Inactive) {
        return redirect()->back()->with('login_error', 'Wrong username/password');
      }
      if ($requester->stat == RequesterStat::PendingPayment) {
        return redirect()->back()->with('login_error', 'Please make payment according to the sent email and wait for operator to approve your account');
      }
      Auth::loginUsingId($requester->user_id);
      return redirect('account')->with('msg', 'Logged in');
    }

    return view("frontend/login");
  }

  public function account(Request $request) {
    if ($request->isMethod("post")) {
      $account_service  = new Account();
      $input = $request->all();
      if (! $account_service->saveAccount($input, $this->getUsername())) {
        return redirect()->back()->withErrors($account_service->getValidation())->withInput($input);
      }
      return redirect('account')->with('msg', 'Account saved');
    }
    $requester_service = new Requester();
    $requester = $requester_service->getRequesterByUsername($this->getUsername());
    $data['requester'] = $requester;
    $company_service = new CompanyService();
    if ($requester->admin) {
      $data['offices'] = $company_service->getOfficeAll($requester->company_id);
    }
    return view('frontend/account', $data);
  }

  public function logout(Request $request)
  {
    Auth::logout();
    return redirect("login")->with('msg', 'Logged out');
  }

  public function registerSuccess(Request $request)
  {
    $data['username'] = $request->session()->get('username');
    return view("frontend/register-success", $data);
  }

  public function register(Request $request)
  {
    if ($request->isMethod("post")) {
      $register = new Account();
      $input = $request->all();
      $username = $register->saveRegister($input);
      if ($username === false) {
        return redirect()->back()->withErrors($register->getValidation())->withInput($input);
      }
      return redirect('register-success')->with('register_username', $username);
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

  public function pricing(Request $request)
  {
    return view("frontend/pricing");
  }

  public function contact(Request $request)
  {
    return view("frontend/contact");
  }

  public function error(Request $request)
  {
    return view("frontend/error");
  }

  public function q() {
    $this->dispatch(new TicketQuotationEmail());
  }


}