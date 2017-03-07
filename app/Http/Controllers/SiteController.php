<?php

namespace App\Http\Controllers;

use App;
use App\Mail\Quotation;
use App\Models\User;
use Mail;

class SiteController extends Controller
{
  public function index()
  {
    //$product = DB::collection('product')->get();
    //var_dump($product); exit;
    return view("index");
  }

  public function mail() {
    echo App::environment('local');
    //https://laracasts.com/series/laravel-from-scratch-2017/episodes/27
    //Mail::to($user = User::first())->send(new Quotation());

  }
}
  
  