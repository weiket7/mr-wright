<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeleteLog;
use App\Models\Skill;
use DB;
use Illuminate\Http\Request;

class SkillController extends Controller
{
  public function index() {
    $data['skills'] = Skill::orderBy('name')->get();
    return view("admin/skill/index", $data);
  }

  public function save(Request $request, $skill_id = null) {
    $action = $skill_id == null ? 'create' : 'update';
    $skill = $skill_id == null ? new Skill() : Skill::find($skill_id);
  
    if($request->isMethod('post')) {
      $input = $request->all();
      
      if ($input["delete"] == "true") {
        $skill->deleteSkill();
        (new DeleteLog())->saveDeleteLog('skill', $skill_id, $skill->name, $this->getUsername());
        return redirect("admin/skill  ")->with("msg", "Skill deleted");
      }
  
      if (!$skill->saveSkill($input, $request->file("image"))) {
        return redirect()->back()->withErrors($skill->getValidation())->withInput($input);
      }
      return redirect('admin/skill/save/' . $skill->skill_id)->with('msg', 'Skill ' . $action . "d");
    }
      
    $data['action'] = $action;
    $data['skill'] = $skill;
    
    return view('admin/skill/form', $data);
  }

}