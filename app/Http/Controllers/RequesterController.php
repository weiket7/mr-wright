<?php

namespace App\Http\Controllers;

use App\Models\Enums\UserType;
use App\Models\Requester;
use Illuminate\Http\Request;

class RequesterController extends Controller
{
  public function index()
  {
    $data['requesters'] = Requester::all();
    return view("requester/index", $data);
  }

  public function save(Request $request, $requester_id) {
    $data['action'] = $requester_id == null ? 'create' : 'update';
    $data['requester'] = Requester::findOrNew($requester_id);
    return view('requester/form', $data);
  }

}