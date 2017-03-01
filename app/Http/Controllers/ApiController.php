<?php

namespace App\Http\Controllers;

use App;
use App\Models\Services\SkillService;
use Illuminate\Http\Request;

class ApiController extends Controller
{
  /*protected $skill_service;

  public function __construct(SkillService $skill_service)
  {
    $this->skill_service = $skill_service;
  }*/

  public function getStaffCalendar(Request $request) {
    //$skills = $this->skill_service->getSkillAll();
    $selected_skills = $request->get('selected_skills');
    //get staff with skills
    //get staff slots
    return [
        'columns' => ['Tom', 'Jerry'],
        'cells' => [
          'Tom'=>['10:00'=>['text'=>'AAA', 'background'=>'blue'], '10:30'=>['text'=>'AAA', 'background'=>'blue']],
          'Sam'=>['10:00'=>['text'=>'AAA', 'background'=>'blue'], '10:30'=>['text'=>'AAA', 'background'=>'blue']],
        ]
      ];
  }
}