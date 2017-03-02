<?php

namespace App\Http\Controllers;

use App;
use App\Models\Services\CalendarService;
use App\Models\Services\SkillService;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
  protected $calendar_service;

  public function __construct(CalendarService $calendar_service)
  {
    $this->calendar_service = $calendar_service;
  }

  public function getStaffCalendar(Request $request) {
    Log::info($request->get('selected_skills'));
    //$selected_skills = $request->get('selected_skills');
    $selected_skills = ['Mechanical', 'Electrical'];
    $staffs = $this->calendar_service->getStaffWithSkills($selected_skills);
    $calendar = $this->calendar_service->getStaffCalendar($staffs);
    //get staff with selected skills
    //get their calendar

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