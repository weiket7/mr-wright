<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Services\WorkingHourService;
use Illuminate\Http\Request;

class WorkingHourController extends Controller
{
  protected $working_hour_service;

  public function __construct(WorkingHourService $working_hour_service)
  {
    $this->working_hour_service = $working_hour_service;
  }

  public function workingDaytime() {
    $data['working_day_time']  = $this->working_hour_service->getWorkingDayTime();
    return view("admin/working-hour/working-day-time", $data);
  }

  public function blockedDate() {
    $data['blocked_dates']  = $this->working_hour_service->getBlockedDate();
    return view("admin/working-hour/blocked-date", $data);
  }

  public function blockedDateTime() {
    $data['blocked_date_times']  = $this->working_hour_service->getBlockedDateTime();
    return view("admin/working-hour/blocked-date-time", $data);
  }

  
}