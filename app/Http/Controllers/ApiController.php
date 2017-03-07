<?php

namespace App\Http\Controllers;

use App;
use App\Models\Services\CalendarService;
use App\Models\Services\SkillService;
use App\Models\Services\WorkingHourService;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
  protected $calendar_service;
  protected $working_hour_service;

  public function __construct(CalendarService $calendar_service, WorkingHourService $working_hour_service)
  {
    $this->calendar_service = $calendar_service;
    $this->working_hour_service = $working_hour_service;
  }

  public function getStaffWithSkills(Request $request) {
    //Log::info($request->get('skills'));
    $skills = explode(",", $request->get('skills'));
    return $this->calendar_service->getStaffWithSkills($skills);
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

    $staffs = explode(",", $request->get('staffs'));
    $res = $this->calendar_service->getStaffCalendar($date, $staffs);
    $staffs = $res['staffs'];
    $intervals = $res['intervals'];
    $staff_intervals = $res['staff_intervals'];

    $columns = [];
    $rows = [];
    //var_dump($intervals); exit;
    foreach($intervals as $i) {
      foreach($staffs as $staff) {
        $rows[$i][] = $staff_intervals[$staff->staff_id][$i];
      }
    }

    $res = [
      'columns' => $staffs,
      'rows' => $rows,
      'intervals' => $intervals,
      'staffs' => $staffs,
    ];
    return $res;

    /*return [
      'columns' => ['Tom', 'Jerry'],
      'rows' => [
        '10:30'=>[['text'=>'AAA', 'background'=>'blue'], ['text'=>'AAA', 'background'=>'blue']],
        '11:00'=>[['text'=>'BBBB', 'background'=>'blue'], ['text'=>'DDD', 'background'=>'blue']],
        '11:30'=>[['text'=>'EE', 'background'=>'blue'], ['text'=>'F', 'background'=>'blue']],
      ],
      'intervals' => ['10:30', '11:00', '11:30']
    ];*/
  }
}