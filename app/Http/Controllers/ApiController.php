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

  public function getStaffWithSkills(Request $request)
  {
    Log::info($request->get('selected_skills'));
    $selected_skills = explode(",", $request->get('selected_skills'));
    return $this->calendar_service->getStaffWithSkills($selected_skills);
  }

  public function getStaffCalendar(Request $request) {
    Log::info($request->get('selected_staffs'));
    $selected_staffs = explode(",", $request->get('selected_staffs'));
    $date = '2017-03-07';
    $res = $this->calendar_service->getStaffCalendar($date, $selected_staffs);
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
    foreach($res['staffs'] as $staff) {
      $columns[] = $staff->name;
    }

    $res = [
      'columns' => $columns,
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