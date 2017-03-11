<?php

namespace App\Http\Controllers;

use App;
use App\Models\Services\StaffService;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
  protected $staff_service;

  public function __construct(StaffService $staff_service)
  {
    $this->staff_service = $staff_service;
  }

  public function index()
  {
    $data['staffs'] = Staff::all();
    return view("staff/index", $data);
  }

  public function save(Request $request, $staff_id = null) {
    $action = $staff_id == null ? 'create' : 'update';
    $staff = $this->staff_service->getStaff($staff_id);

    if($request->isMethod('post')) {
      $input = $request->all();
      /*if (!$staff->saveStaff($input)) {
        return redirect()->back()->withErrors($staff->getValidation())->withInput($input);
      }*/
      return redirect('staff/save/' . $staff->staff_id)->with('msg', 'Staff ' . $action . "d");
    }

    $data['action'] = $action;
    $data['staff'] = $staff;
    return view('staff/form', $data);
  }

}