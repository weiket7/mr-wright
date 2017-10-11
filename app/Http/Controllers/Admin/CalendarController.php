<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Services\WorkingHourService;
use App\Models\BlockedDate;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
  protected $working_hour_service;

  public function __construct(WorkingHourService $working_hour_service)
  {
    $this->working_hour_service = $working_hour_service;
  }

  public function workingDaytime() {
    $data['working_day_time']  = $this->working_hour_service->getWorkingDayTime();
    return view("admin/calendar/working-day-time", $data);
  }

  public function blockedDate() {
    $data['blocked_dates']  = $this->working_hour_service->getBlockedDate();
    return view("admin/calendar/blocked-date", $data);
  }
  
  public function blockedDateSave(Request $request, $blocked_date_id = null) {
    $action = $blocked_date_id == null ? 'create' : 'update';
    $blocked_date = $blocked_date_id == null ? new BlockedDate() : BlockedDate::find($blocked_date_id);
    
    if($request->isMethod('post')) {
      $input = $request->all();
  
      if ($input["delete"] == "true") {
        $blocked_date->delete();
        return redirect("admin/blocked-date")->with("msg", "Blocked date deleted");
      }
      
      if (!$blocked_date->saveBlockedDate($input)) {
        return redirect()->back()->withErrors($blocked_date->getValidation())->withInput($input);
      }
      return redirect('admin/blocked-date/save/' . $blocked_date->working_date_blocked_id)->with('msg', 'Blocked date ' . $action . "d");
    }
    
    $data['action'] = $action;
    $data['blocked_date'] = $blocked_date;
    return view('admin/calendar/blocked-date-form', $data);
  }

  public function blockedDateTime() {
    $data['blocked_date_times']  = $this->working_hour_service->getBlockedDateTime();
    return view("admin/calendar/blocked-date-time", $data);
  }

  
}