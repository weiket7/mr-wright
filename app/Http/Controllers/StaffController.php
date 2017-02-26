<?php

namespace App\Http\Controllers;

use App;
use App\Models\Product;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
  public function index()
  {
    $data['staffs'] = Staff::all();
    return view("staff/index", $data);
  }

  public function save(Request $request, $staff_id) {
    $data['action'] = $staff_id == null ? 'create' : 'update';
    $data['staff'] = Staff::findOrNew($staff_id);
    return view('staff/form', $data);
  }

}