<?php

namespace App\Http\Controllers;

use App;
use App\Models\Office;
use App\Models\Services\CalendarService;
use App\Models\Services\CompanyService;
use App\Models\Services\SkillService;
use App\Models\Services\WorkingHourService;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
  protected $calendar_service;
  protected $working_hour_service;
  protected $company_service;

  public function __construct(CalendarService $calendar_service, WorkingHourService $working_hour_service, CompanyService $company_service)
  {
    $this->calendar_service = $calendar_service;
    $this->working_hour_service = $working_hour_service;
    $this->company_service = $company_service;
  }

  public function getStaffWithSkills(Request $request) {
    //Log::info($request->get('skills'));
    $skill_ids = explode(",", $request->get('skill_ids'));
    return $this->calendar_service->getStaffWithSkills($skill_ids);
  }

  public function getStaffCalendar(Request $request) {
    $date = $request->get('date');
    $is_date_blocked = $this->working_hour_service->isDateBlocked($date);
    if ($is_date_blocked) {
      return ['is_date_blocked'=>true];
    }
  
    $is_non_working_day = $this->working_hour_service->isNonWorkingDay($date);
    if ($is_non_working_day) {
      return ['is_non_working_day'=>true];
    }

    $staff_ids = explode(",", $request->get('staff_ids'));
    $res = $this->calendar_service->getStaffCalendar($date, $staff_ids);

    return $res;
  }

  //TODO secure these 3 api, if operator can access all, if requester only those under his company and/or office
  public function getOfficeByCompany(Request $request) {
    $company_id = $request->get('company_id');
    return $this->company_service->getOfficeDropdown($company_id);
  }

  public function getRequesterByOffice(Request $request) {
    $office_id = $request->get('office_id');
    return $this->company_service->getRequesterDropdown($office_id);
  }

  public function getOffice(Request $request) {
    return Office::find($request->get('office_id'));
  }
}