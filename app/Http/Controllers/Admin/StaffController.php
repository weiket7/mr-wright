<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Services\DashboardService;
use App\Models\Services\TicketService;
use App\Models\Skill;
use App\Models\Staff;
use App\Models\Ticket;
use Auth;
use Illuminate\Http\Request;

class StaffController extends Controller
{
  public function index()
  {
    $data['staffs'] = Staff::getStaffAll();
    return view("admin/staff/index", $data);
  }
  
  public function dashboard() {
    $username = Auth::user()->username;
    $dashboard_service = new DashboardService();
    $data['tickets'] = $dashboard_service->getStaffAssignedTickets($username);
    return view("admin/staff/dashboard", $data);
  }
  
  public function otp(Request $request, $ticket_id) {
    $ticket_service = new TicketService();
    $ticket = $ticket_service->getTicket($ticket_id);
    $data['ticket'] = $ticket_service->populateTicketForView($ticket);
    return view("admin/staff/otp", $data);
  }
  
  public function save(Request $request, $staff_id = null) {
    $action = $staff_id == null ? 'create' : 'update';
    $staff = $staff_id == null ? new Staff() : Staff::find($staff_id);

    if($request->isMethod('post')) {
      $input = $request->all();
      if ($input["delete"] == "true") {
        $staff->deleteStaff();
        return redirect("admin/staff")->with("msg", "Staff deleted");
      }
  
      if (!$staff->saveStaff($input)) {
        return redirect()->back()->withErrors($staff->getValidation())->withInput($input);
      }
      return redirect('admin/staff/save/' . $staff->staff_id)->with('msg', 'Staff ' . $action . "d");
    }

    $data['action'] = $action;
    $data['staff'] = $staff;
    $data['staff_skills'] = $staff->getStaffSkills();
    $data['available_skills'] = $staff->getAvailableSkills($data['staff_skills']);
    $data['staff_assignments'] = $staff->getStaffAssignments();

    return view('admin/staff/form', $data);
  }

}