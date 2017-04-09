<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\Services\AccessService;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
  protected $access_service;

  public function __construct(AccessService $access_service)
  {
    $this->access_service = $access_service;
  }

  public function index()
  {
    $data['roles'] = Role::all();
    return view("role/index", $data);
  }

  public function save(Request $request, $role_id = null) {
    $action = $role_id == null ? 'create' : 'update';
    $role = $role_id == null ? new Role() : Role::find($role_id);

    if($request->isMethod('post')) {
      $input = $request->all();
      if (!$role->saveRole($input)) {
        return redirect()->back()->withErrors($role->getValidation())->withInput($input);
      }
      return redirect('role/save/' . $role->role_id)->with('msg', 'Role ' . $action . "d");
    }

    $data['role_accesses'] = $this->access_service->getRoleAccess($role_id);
    $data['available_accesses'] = $this->access_service->getAvailableAccess($data['role_accesses']);
    $data['action'] = $action;
    $data['role'] = $role;
    return view('role/form', $data);
  }

}