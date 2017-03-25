<?php

namespace App\Http\Controllers;

use App;
use App\Mail\QuotationMail;
use App\Models\Enums\UserStat;
use App\Models\Services\DashboardService;
use App\Models\Services\TicketService;
use App\Models\Ticket;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Mail;

class SiteController extends Controller
{
  protected $ticket_service;
  protected $dashboard_service;

  public function __construct(DashboardService $dashboard_service, TicketService $ticket_service)
  {
    $this->dashboard_service = $dashboard_service;
    $this->ticket_service = $ticket_service;
  }

  public function index() {
    $data['tickets'] = $this->dashboard_service->getTicketsRecent();
    $data['staff_assignments'] = $this->dashboard_service->getStaffAssignmentsToday();
    return view("index", $data);
  }

  public function logout() {
    Auth::logout();
    return redirect("login")->with('msg', 'Logged out');
  }

  public function login(Request $request) {
    Auth::logout();
    if($request->isMethod('post')) {
      $username = $request->get("username");
      $password = trim($request->get("password"));
      if (! Auth::attempt(['username'=>$username, 'password'=>$password, 'stat'=>UserStat::Active])) {
        return redirect()->back()->with('msg', 'Wrong username and/or password');
      }
      //$request->session()->put('supplier_id', $user->getSupplierIdByRole());
      //$request->session()->put('outlet_id', $user->getOutletIdByRole());
      $referrer = $request->session()->has('referrer');
      if ($referrer) {
        return redirect($request->session()->pull('referrer'));
      }
      return redirect('/')->with('msg', 'Logged in');
    }
    return view('site/login');
  }

  public function categoryForTicket() {
    $data['categories'] = $this->ticket_service->getCategoryDropdown();
    return view('site/category-for-ticket', $data);
  }

  public function setting() {
    return view('site/setting');
  }

  public function system() {
    return view('site/system');
  }

  public function error() {
    return view('error');
  }
}
  
  