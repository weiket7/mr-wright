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

  public function getStaffCalendar(Request $request) {
    Log::info($request->get('selected_skills'));
    $selected_skills = explode(",", $request->get('selected_skills'));
    //$selected_skills = ['Mechanical', 'Electrical'];
    $date = '2017-03-07';
    $staffs = $this->calendar_service->getStaffWithSkills($selected_skills);
    $calendar = $this->calendar_service->getStaffCalendarWithSkills($date, $selected_skills);
    //"1":{"10:00":{"text":"","ticket_id":0},"10:15":{"text":"","ticket_id":0},"10:30":{"text":"","ticket_id":0},"10:45":{"text":"","ticket_id":0}
    //var_dump($calendar);
    $intervals = $this->working_hour_service->getWorkingIntervalsByDate($date);


    $columns = [];
    $rows = [];
    //var_dump($staffs);
    foreach($intervals as $i) {
      foreach($staffs as $staff) {
        $rows[$i][] = $calendar[$staff->staff_id][$i];
      }
    }
    foreach($staffs as $staff) {
      $columns[] = $staff->name;
    }

    $res = [
      'columns' => $columns,
      'rows' => $rows,
      'intervals' => $intervals
    ];
    //var_dump($res['rows']);
    return $res;

    //vaR_dump($calendar); exit;

    return [
      'columns' => ['Tom', 'Jerry'],
      'rows' => [
        '10:30'=>[['text'=>'AAA', 'background'=>'blue'], ['text'=>'AAA', 'background'=>'blue']],
        '11:00'=>[['text'=>'BBBB', 'background'=>'blue'], ['text'=>'DDD', 'background'=>'blue']],
        '11:30'=>[['text'=>'EE', 'background'=>'blue'], ['text'=>'F', 'background'=>'blue']],
      ],
      'intervals' => ['10:30', '11:00', '11:30']
    ];
  }
}