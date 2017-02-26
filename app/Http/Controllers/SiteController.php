<?php

namespace App\Http\Controllers\Admin;

use App;
use App\Bookcase;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Size;
use DB;

class SiteController extends Controller
{
  public function index()
  {
    //$product = DB::collection('product')->get();
    //var_dump($product); exit;
    return view("index");
  }
  
  public function test() {
    $size = new Size();
    $size->name = "Game of Thrones";
    
    $product = Product::first();
    $product->sizes()->save($size);
  }
}
  
  