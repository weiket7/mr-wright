<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
  public function index()
  {
    return view("index");
  }
  
  public function save(Request $request, $company_id) {
    
  }
  
}