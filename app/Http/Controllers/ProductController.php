<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  public function index()
  {
    $data['products'] = Product::all();
    $data['brands'] = [];
    $data['categories'] = [];
    return view("product/index", $data);
  }
  
  public function save(Request $request, $product_id = null)
  {
    $action = $product_id == null ? 'create' : 'update';
    $product = Product::find($product_id)->first();
    if($request->isMethod('post')) {
      $input = $request->all();
      $product->saveProduct($input);
    }
    
    $data['product'] = $product;
    //var_dump($data['product']); exit;
    return view("product/form", $data);
  }
}
  
  