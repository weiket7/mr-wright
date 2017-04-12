<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Operator;
use App\Models\Role;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
  protected $operator_service;
  protected $role_service;

  public function __construct(Operator $operator_service, Role $role_service)
  {
    $this->operator_service = $operator_service;
    $this->role_service = $role_service;
  }

  public function index() {
    $data['operators'] = $this->operator_service->getOperatorAll();
    $data['roles'] = $this->role_service->getRoleDropdown();
    return view("admin/operator/index", $data);
  }

  public function save(Request $request, $operator_id = null) {
    $action = $operator_id == null ? 'create' : 'update';
    $operator = $operator_id == null ? new Operator() : Operator::find($operator_id);

    if($request->isMethod('post')) {
      $input = $request->all();
      if (!$operator->saveOperator($input)) {
        return redirect()->back()->withErrors($operator->getValidation())->withInput($input);
      }
      return redirect('admin/operator/save/' . $operator->user_id)->with('msg', 'Operator ' . $action . "d");
    }

    $data['action'] = $action;
    $data['operator'] = $operator;
    $data['roles'] = $this->role_service->getRoleDropdown();
    return view('admin/operator/form', $data);
  }

}