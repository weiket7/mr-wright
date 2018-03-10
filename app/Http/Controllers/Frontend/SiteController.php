<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Mail\InviteMail;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Enums\MembershipStat;
use App\Models\Enums\UserStat;
use App\Models\Enums\UserType;
use App\Models\ForgotPassword;
use App\Models\FrontendDynamic;
use App\Models\FrontendService;
use App\Models\Registration;
use App\Models\Invite;
use App\Models\Membership;
use App\Models\Office;
use App\Models\Requester;
use Auth;
use Illuminate\Http\Request;
use Log;
use Mail;

class SiteController extends Controller
{
  protected $account_service;
  
  public function __construct(Registration $account_service)
  {
    $this->account_service = $account_service;
  }

  public function index() {
    $frontend_service = new FrontendService();
    $services = $frontend_service->getServiceAll();
    $data['services'] = $services->toArray();
    return view("frontend/index", $data);
  }

  public function login(Request $request) {
    $input = $request->all();
    if ($request->isMethod("post")) {
      $login = Auth::attempt(['username' => trim($input['username']), 'password' => trim($input['password']), 'stat'=>UserStat::Active, 'type'=>UserType::Requester]);
      $requester_exist = Requester::where('username', $input['username'])->count() > 0;
      if ($login == false || $requester_exist == false) {
        return redirect()->back()->with('login_error', 'Wrong username/password');
      }
      $referral = $request->get('referral');
      if (! empty($referral)) {
        return redirect($referral)->with('msg', 'Logged in');
      }
      return redirect('ticket')->with('msg', 'Logged in');
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

    $requester = Requester::where('username', $this->getUsername())->first();
    if ($requester->admin) {
      $data['offices'] = Office::where('company_id', $requester->company_id)->get();
    }
    $data['requester'] = $requester;
    $data['company'] = Company::find($requester->company_id);
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
    $requester = Requester::where('username', $this->getUsername())->first();
    $company_service = new Company();
    $data['requesters'] = $company_service->getRequesterByCompany($requester->company_id);
    $data['registrations'] = $this->account_service->getPendingRegistrations($requester->company_id);
    $data['offices'] = Office::getOfficeDropdown($requester->company_id);
    $data['hit_requester_limit'] = $this->account_service->hitRequesterLimit($requester->company_id);
    $data['company'] = Company::find($requester->company_id);
    return view('frontend/members', $data);
  }

  //no link to this in frontend
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
    $data['offices'] = Office::getOfficeDropdown($requester->company_id);
    return view('frontend/members-form', $data);
  }

  public function membersRegistration(Request $request, $registration_id) {
    $registration = Registration::findOrFail($registration_id);
    if ($request->isMethod("post")) {
      $account_service = new Registration();
      $registration = $account_service->approveRegistration($registration, $request->all());
      $account_service->emailApproveRegistration($registration);
      return redirect('members/registration/'.$registration_id)->with('msg', 'Registration approved');
    }
    $logged_in_requester = $this->getLoggedInRequester();
    $data['registration'] = $registration;
    $data['offices'] = Office::getOfficeDropdown($logged_in_requester->company_id);
    return view('frontend/members-registration', $data);
  }

  public function membersInvite(Request $request, $token) {
    $invite = Invite::where('token', $token)->first();
    if($invite == null) { return redirect('error')->with('error', 'Invitation does not exist'); }

    if($request->isMethod('post')) {
      $input = $request->all();
      $invite_service = new Invite();
      $user = $invite_service->acceptInvite($input, $token);
      $account_service = new Registration();
      $company_id = Requester::where('username', $user->username)->value('company_id');
      $account_service->updateCompanyOfficeRequesterCount($company_id);
      Auth::login($user);
      return redirect('account')->with('welcome', true);
    }
    $data['invite'] = $invite;
    return view('frontend/members-invite', $data);
  }

  public function service(Request $request, $slug = null) {
    if (! empty($slug) && FrontendService::where('slug', $slug)->count() == 0) {
      return view('frontend/error', ['error'=>'Service does not exist']);
    }
    
    $frontend_service = new FrontendService();
    $services = $frontend_service->getServiceAll();
    $data['services'] = $services->keyBy("slug");
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
    $data['memberships'] = $membership_service->getMembershipAll(MembershipStat::Active);
    return view("frontend/membership", $data);
  }

  public function contact(Request $request) {
    if($request->isMethod('post')) {
      $input = $request->all();
      $contact = new Contact();
      if (! $contact->saveContact($input)) {
        return redirect()->back()->withErrors($contact->getValidation())->withInput($input);
      }
      Mail::to(config('mail.from.address'))->send(new ContactMail($contact));
      return redirect()->back()->with('sent', true);
    }
    return view("frontend/contact");
  }
  
  public function dynamic(Request $request, $url) {
    $data['dynamic'] = FrontendDynamic::where(['url'=>$url])->first();
    return view("frontend/dynamic", $data);
  }

  public function error(Request $request) {
    return view("frontend/error");
  }

  private function getLoggedInRequester() {
    return Requester::where('username', $this->getUsername())->first();
  }

}