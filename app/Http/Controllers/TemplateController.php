<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemplateController extends Controller
{
  public function index()
  {
    $data['products'] = Product::all();
    return view("product/index", $data);
  }
  
  public function save(Request $request, $product_id) {
    $data['action'] = $product_id == null ? 'create' : 'update';
    $data['product'] = Product::findOrNew($product_id);
    return view('product/form', $data);
  }
  
}