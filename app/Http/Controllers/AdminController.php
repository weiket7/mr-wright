<?php

namespace App\Http\Controllers;

use App;
use App\Mail\QuotationMail;
use App\Models\Enums\Role;
use App\Models\Enums\UserStat;
use App\Models\Services\AccessService;
use App\Models\Services\DashboardService;
use App\Models\Services\TicketService;
use App\Models\Ticket;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Mail;

class AdminController extends Controller
{
  protected $access_service;
  protected $ticket_service;
  protected $dashboard_service;

  public function __construct(DashboardService $dashboard_service, TicketService $ticket_service, AccessService $access_service)
  {
    $this->dashboard_service = $dashboard_service;
    $this->ticket_service = $ticket_service;
    $this->access_service = $access_service;
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

      $user = Auth::user();
      $request->session()->put('accesses', $this->access_service->getAccess($user));
      //$request->session()->put('outlet_id', $user->getOutletIdByRole());
      $referrer = $request->session()->has('referrer');
      if ($referrer) {
        return redirect($request->session()->pull('referrer'));
      }
      return redirect('/')->with('msg', 'Logged in');
    }
    return view('site/login');
  }
  public function error() {
    return view('error');
  }
}
  
  