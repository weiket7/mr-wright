<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Product;

class BaseController extends Controller
{
  protected function getUsername() {
    return Auth::user()->username;
  }

}