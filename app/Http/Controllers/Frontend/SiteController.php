<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\InviteMail;
use App\Models\Enums\RequesterStat;
use App\Models\ForgotPassword;
use App\Models\FrontendService;
use App\Models\Account;
use App\Models\Invite;
use App\Models\Membership;
use App\Models\Office;
use App\Models\Registration;
use App\Models\Requester;
use App\Models\Services\CompanyService;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Log;
use Mail;

class SiteController extends Controller
{
  protected $company_service;

  public function __construct(CompanyService $company_service)
  {
    $this->company_service = $company_service;
  }

  public function index() {
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
      $referral = $request->get('referral');
      if (! empty($referral)) {
        return redirect($referral)->with('msg', 'Logged in');
      }
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
    if ($requester->admin) {
      $data['offices'] = $this->company_service->getOfficeAll($requester->company_id);
    }
    return view('frontend/account', $data);
  }

  public function inviteRegistration(Request $request, $registration_id) {
    $registration = Registration::findOrFail($registration_id);
    if ($request->isMethod("post")) {
      $account_service = new Account();
      $account_service->approveRegistration($registration_id, false);
    }
    $data['requester'] = Requester::where('company_id', $registration->company_id)->first();
    $data['registration'] = $registration;
    return view('frontend/invite-registration', $data);
  }

  public function officeSave(Request $request, $office_id = null) {
    $action = $office_id == null ? 'create' : 'update';
    $office = $office_id == null ? new Office() : Office::find($office_id);

    if($request->isMethod('post')) {
      $input = $request->all();
      if (!$office->saveOffice($input, false  )) {
        return redirect()->back()->withErrors($office->getValidation())->withInput($input);
      }
      return redirect('office/save/' . $office->office_id)->with('msg', 'Office ' . $action . "d");
    }

    $data['action'] = $action;
    $data['office'] = $office;
    $data['requester_count'] = Requester::where('office_id', 'office_id')->count();
    return view('frontend/office-form', $data);
  }

  public function invite(Request $request) {
    if($request->isMethod('post')) {
      $input = $request->all();
      $invite_service = new Invite();
      $invite = $invite_service->saveInvite($input, $this->getUsername());
      if ($invite == false) {
        return redirect('invite')->withErrors($invite_service->getValidation())->withInput($input);
      }
      Mail::to($invite->email)->send(new InviteMail($invite->token));
      $request->session()->flash('invite', $invite->email);
    }
    $requester = Requester::where('username', $this->getUsername())->first();
    $data['registrations'] = Registration::where('company_id', $requester->company_id)->get();
    $data['offices'] = $this->company_service->getOfficeDropdown($requester->company_id);
    return view('frontend/invite', $data);
  }

  public function inviteAccept(Request $request, $token) {
    if($request->isMethod('post')) {
      $input = $request->all();
      $invite_service = new Invite
      ();
      $user = $invite_service->acceptInvite($input, $token);
      Auth::login($user);
      return redirect('account')->with('welcome', true);
    }
    $invite = Invite::where('token', $token)->firstOrFail();
    $data['invite'] = $invite;
    return view('frontend/invite-accept', $data);
  }

  public function service(Request $request, $slug = null) {
    $frontend_service = new FrontendService();
    $data['services'] = $frontend_service->getServiceAll();
    if ($slug == null) {
      $data['current_service'] = array_first($data['services']);
    } else {
      $data['current_service'] = $data['services'][$slug];
    }
    return view("frontend/service", $data);
  }
  
  public function forgotPassword(Request $request) {
    if ($request->isMethod('post')) {
      $forgot_password = new ForgotPassword();
      $input = $request->all();
      if (! $forgot_password->saveForgotPasswordAndEmail($input)) {
        return redirect('forgot-password')->withErrors($forgot_password->getValidation())->withInput($input);
      }
      return redirect('forgot-password')->with('msg', 'If the email is valid, a new password will be emailed to you shortly');
    }
    return view('frontend/forgot-password');
  }

  public function logout(Request $request)
  {
    Auth::logout();
    return redirect("login")->with('msg', 'Logged out');
  }

  public function about(Request $request)
  {
    return view("frontend/about");
  }


  public function project(Request $request)
  {
    return view("frontend/project");
  }

  public function membership(Request $request) {
    $membership_service = new Membership();
    $data['memberships'] = $membership_service->getMembershipAll();
    return view("frontend/membership", $data);
  }

  public function contact(Request $request)
  {
    return view("frontend/contact");
  }

  public function error(Request $request)
  {
    return view("frontend/error");
  }


}