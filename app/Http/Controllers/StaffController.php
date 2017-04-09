<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
  protected $skill;
  
  public function __construct(Skill $skill)
  {
    $this->skill = $skill;
  }

  public function index()
  {
    $data['staffs'] = Staff::getStaffAll();
    return view("staff/index", $data);
  }

  public function save(Request $request, $staff_id = null) {
    $action = $staff_id == null ? 'create' : 'update';
    $staff = $staff_id == null ? new Staff() : Staff::find($staff_id);

    if($request->isMethod('post')) {
      $input = $request->all();
      if (!$staff->saveStaff($input)) {
        return redirect()->back()->withErrors($staff->getValidation())->withInput($input);
      }
      return redirect('staff/save/' . $staff->staff_id)->with('msg', 'Staff ' . $action . "d");
    }

    $data['action'] = $action;
    $data['staff'] = $staff;
    $data['staff_skills'] = $staff->getStaffSkills();
    $data['available_skills'] = $staff->getAvailableSkills($data['staff_skills']);

    return view('staff/form', $data);
  }

}