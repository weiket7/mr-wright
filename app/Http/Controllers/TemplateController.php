<?php

namespace App\Http\Controllers;

use App;
use App\Models\Product;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
  public function index()
  {
    return view("product/index");
  }
  
  public function save(Request $request, $product_id) {
    $data['product'] = $product_id == null ? new Product() : Product::find($product_id);
    return view('product/form', $data);
  }
  
}