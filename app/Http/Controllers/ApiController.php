<?php

namespace App\Http\Controllers;

use App;
use App\Models\Services\SkillService;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
  /*protected $skill_service;

  public function __construct(SkillService $skill_service)
  {
    $this->skill_service = $skill_service;
  }*/

  public function getStaffCalendar(Request $request) {
    Log::info($request->get('selected_skills'));
    $selected_skills = $request->get('selected_skills');

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