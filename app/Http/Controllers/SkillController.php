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
    $data['action'] = $skill_id == null ? 'create' : 'update';
    $data['skill'] = $skill_id == null ? new Skill() : Skill::find($skill_id);
    return view('skill/form', $data);
  }

}