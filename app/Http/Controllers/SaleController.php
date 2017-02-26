<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SaleController extends Controller
{
  public function index()
  {
    //$product = DB::collection('product')->get();
    //var_dump($product); exit;
    return view("sale/form");
  }
  
  public function save(Request $request, $product_id = null)
  {
    $action = $product_id == null ? 'create' : 'update';
    $product = Product::where(['name'=>'Apple'])->first();
    if($request->isMethod('post')) {
      $input = $request->all();
      $product->saveProduct($input);
    }
    
    $data['product'] = $product;
    //var_dump($data['product']); exit;
    return view("product/form", $data);
  }
}
  
  