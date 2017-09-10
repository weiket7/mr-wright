<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enums\UserStat;
use App\Models\Enums\UserType;
use App\Models\Services\AccessService;
use App\Models\Services\DashboardService;
use App\Models\Services\TicketService;
use Auth;
use Illuminate\Http\Request;
use Log;

class AdminController extends Controller
{
  protected $access_service;
  protected $ticket_service;

  public function __construct(TicketService $ticket_service, AccessService $access_service) {
    $this->ticket_service = $ticket_service;
    $this->access_service = $access_service;
  }
  
  public function dashboard() {
    $dashboard_service = new DashboardService();
    $data['new_ticket_count'] = $dashboard_service->getNewTicketCount();
    $data['new_ticket_value'] = $dashboard_service->getNewTicketValue();
    $data['completed_ticket_count_monthly'] = $dashboard_service->getCompletedTicketCountMonthly();
    $data['completed_ticket_value_monthly'] = $dashboard_service->getCompletedTicketValueMonthly();
    $data['completed_ticket_value'] = $dashboard_service->getCompletedTicketValue();
    $data['tickets'] = $dashboard_service->getTicketsRecent();
    $data['staff_assignments'] = $dashboard_service->getStaffAssignmentsToday();
    return view("admin/index", $data);
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
      if($user->type == UserType::Staff) {
        return redirect('admin/staff/dashboard')->with('msg', 'Logged in');
      }

      $referrer = $request->session()->has('referrer');
      if ($referrer) {
        return redirect($request->session()->pull('referrer'));
      }
      return redirect('admin/dashboard')->with('msg', 'Logged in');
    }
    return view('admin/login');
  }

  public function error() {
    if (! Auth::check()) {
      return redirect('admin/login');
    }
    return view('admin/error');
  }

  public function logout() {
    Auth::logout();
    return redirect("admin/login")->with('msg', 'Logged out');
  }
}
  
  