<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Mail\InviteMail;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Enums\UserStat;
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
use Illuminate\Http\Request;
use Log;
use Mail;

class SiteController extends Controller
{
  protected $company_service;
  protected $account_service;
  
  public function __construct(Account $account_service, CompanyService $company_service)
  {
    $this->account_service = $account_service;
    $this->company_service = $company_service;
  }

  public function index() {
    return view("frontend/index");
  }

  public function login(Request $request) {
    $input = $request->all();
    if ($request->isMethod("post")) {
      /*$account_service = new Account();
      if ($account_service->registrationPending($input['username'])) {
        return redirect()->back()->with('login_error', 'Please make payment according to the sent email and wait for operator to approve your account');
      }*/
      if (! Auth::attempt(['username' => $input['username'], 'password' => $input['password'], 'stat' => UserStat::Active])) {
        return redirect()->back()->with('login_error', 'Wrong username/password');
      }
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
      $input = $request->all();
      if (! $this->account_service->saveAccount($input, $this->getUsername())) {
        return redirect()->back()->withErrors($this->account_service->getValidation())->withInput($input);
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

  public function officeSave(Request $request, $office_id = null) {
    $action = $office_id == null ? 'create' : 'update';
    $office = $office_id == null ? new Office() : Office::find($office_id);

    if($request->isMethod('post')) {
      $input = $request->all();
      $requester = $this->getLoggedInRequester();
      if (!$office->saveOfficeFrontEnd($input, $this->getUsername(), $requester->company_id)) {
        return redirect()->back()->withErrors($office->getValidation())->withInput($input);
      }
      return redirect('office/save/' . $office->office_id)->with('msg', 'Office ' . $action . "d");
    }

    $data['action'] = $action;
    $data['office'] = $office;
    return view('frontend/office-form', $data);
  }

  public function members(Request $request) {
    if($request->isMethod('post')) {
      $input = $request->all();
      $invite_service = new Invite();
      $invite = $invite_service->saveInvite($input, $this->getUsername());
      if ($invite == false) {
        return redirect('members')->withErrors($invite_service->getValidation())->withInput($input);
      }
      Mail::to($invite->email)->send(new InviteMail($invite->token));
      return redirect('members')->with('invited_email', $invite->email);
    }
    $logged_in_requester = Requester::where('username', $this->getUsername())->first();
    $data['requesters'] = $this->company_service->getRequesterByCompany($logged_in_requester->company_id);
    $data['registrations'] = $this->account_service->getPendingRegistrations($logged_in_requester->company_id);
    $data['offices'] = $this->company_service->getOfficeDropdown($logged_in_requester->company_id);
    $data['hit_requester_limit'] = $this->account_service->hitRequesterLimit($logged_in_requester->company_id);
    $data['company'] = Company::find($logged_in_requester->company_id);
    return view('frontend/members', $data);
  }

  //Link to this not added in frontend
  public function membersSave(Request $request, $requester_id = null) {
    $action = $requester_id == null ? 'create' : 'update';
    $requester = $requester_id == null ? new Requester() : Requester::find($requester_id);

    if($request->isMethod('post')) {
      $input = $request->all();
      if (!$requester->saveRequesterFrontend($input, $this->getUsername())) {
        return redirect()->back()->withErrors($requester->getValidation())->withInput($input);
      }
      $this->account_service->updateCompanyOfficeRequesterCount($requester->company_id);
      return redirect('members/save/' . $requester->requester_id)->with('msg', 'Member ' . $action . "d");
    }

    $data['action'] = $action;
    $data['requester'] = $requester;
    $data['offices'] = $this->company_service->getOfficeDropdown($requester->company_id);
    return view('frontend/members-form', $data);
  }

  public function membersRegistration(Request $request, $registration_id) {
    $registration = Registration::findOrFail($registration_id);
    if ($request->isMethod("post")) {
      $account_service = new Account();
      $registration = $account_service->approveRegistration($registration_id, $request->all());
      $account_service->emailApproveRegistration($registration);
      return redirect('members/registration/'.$registration_id)->with('msg', 'Registration approved');
    }
    $logged_in_requester = $this->getLoggedInRequester();
    $data['registration'] = $registration;
    $data['offices'] = $this->company_service->getOfficeDropdown($logged_in_requester->company_id);
    return view('frontend/members-registration', $data);
  }

  public function membersInvite(Request $request, $token) {
    $invite = Invite::where('token', $token)->first();
    if($invite == null) { return redirect('error')->with('error', 'Invitation does not exist'); }

    if($request->isMethod('post')) {
      $input = $request->all();
      $invite_service = new Invite();
      $user = $invite_service->acceptInvite($input, $token);
      Auth::login($user);
      return redirect('account')->with('welcome', true);
    }
    $data['invite'] = $invite;
    return view('frontend/members-invite', $data);
  }

  public function service(Request $request, $slug = null) {
    Log::info($slug);
    if (! empty($slug) && FrontendService::where('slug', $slug)->count() == 0) {
      return view('frontend/error', ['error'=>'Service does not exist']);
    }
    
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

  public function membershipUpgrade(Request $request) {
    
  }
  
  public function logout(Request $request) {
    Auth::logout();
    return redirect("login")->with('msg', 'Logged out');
  }

  public function about(Request $request) {
    return view("frontend/about");
  }

  public function project(Request $request) {
    return view("frontend/project");
  }

  public function membership(Request $request) {
    $membership_service = new Membership();
    $data['memberships'] = $membership_service->getMembershipAll();
    return view("frontend/membership", $data);
  }

  public function contact(Request $request) {
    if($request->isMethod('post')) {
      $input = $request->all();
      $contact = new Contact();
      if (! $contact->saveContact($input)) {
        return redirect('contact')->withErrors($contact->getValidation())->withInput($input);
      }
      Mail::to(config('mail.from.address'))->send(new ContactMail($contact));
      return redirect('contact')->with('sent', true);
    }
    return view("frontend/contact");
  }

  public function error(Request $request) {
    return view("frontend/error");
  }

  private function getLoggedInRequester() {
    return Requester::where('username', $this->getUsername())->first();
  }

}