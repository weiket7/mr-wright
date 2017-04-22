<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
  public function index()
  {
    $data['memberships'] = Membership::all();
    return view("admin/membership/index", $data);
  }
  
  public function save(Request $request, $membership_id = null) {
    $action = $membership_id == null ? 'create' : 'update';
    $membership = $membership_id == null ? new Membership() : Membership::find($membership_id);
    
    if($request->isMethod('post')) {
      $input = $request->all();
      if (!$membership->saveMembership($input)) {
        return redirect()->back()->withErrors($membership->getValidation())->withInput($input);
      }
      return redirect('admin/membership/save/' . $membership->membership_id)->with('msg', 'Membership ' . $action . "d");
    }
    
    $data['action'] = $action;
    $data['membership'] = $membership;
    return view('admin/membership/form', $data);
  }
  
}