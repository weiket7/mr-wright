<?php

namespace App\Http\Controllers;

use App;
use App\Models\Product;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
  public function index()
  {
    $data['skills'] = Skill::all();
    return view("skill/index", $data);
  }

  public function save(Request $request, $skill_id) {
    $action = $skill_id == null ? 'create' : 'update';
    $skill = $skill_id == null ? new Skill() : Skill::find($skill_id);
  
    if($request->isMethod('post')) {
      $input = $request->all();
      if (!$skill->saveSkill($input)) {
        return redirect()->back()->withErrors($skill->getValidation())->withInput($input);
      }
      return redirect('skill/save/' . $skill->skill_id)->with('msg', 'Skill ' . $action . "d");
    }
      
    $data['action'] = $action;
    $data['skill'] = $skill;
    
    return view('skill/form', $data);
  }

}