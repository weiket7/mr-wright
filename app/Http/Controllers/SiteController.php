<?php

namespace App\Http\Controllers;

class SiteController extends Controller
{
  public function index()
  {
    //$product = DB::collection('product')->get();
    //var_dump($product); exit;
    return view("index");
  }
}
  
  