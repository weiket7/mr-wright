<?php

namespace App\Http\Controllers;

use App;
use App\Models\Operator;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
  protected $operator;

  public function __construct(Operator $operator)
  {
    $this->operator = $operator;
  }

  public function index()
  {
    $data['operators'] = $this->operator->getOperatorAll();
    return view("operator/index", $data);
  }

  public function save(Request $request, $operator_id = null) {
    $action = $operator_id == null ? 'create' : 'update';
    $operator = $operator_id == null ? new Operator() : Operator::find($operator_id);

    if($request->isMethod('post')) {
      $input = $request->all();
      if (!$operator->saveOperator($input)) {
        return redirect()->back()->withErrors($operator->getValidation())->withInput($input);
      }
      return redirect('operator/save/' . $operator->user_id)->with('msg', 'Operator ' . $action . "d");
    }

    $data['action'] = $action;
    $data['operator'] = $operator;
    return view('operator/form', $data);
  }

}