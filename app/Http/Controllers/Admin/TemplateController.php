<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
  public function index()
  {
    $data['products'] = Product::all();
    return view("admin/product/index", $data);
  }

  public function save(Request $request, $product_id = null) {
    $action = $product_id == null ? 'create' : 'update';
    $product = $product_id == null ? new Product() : Product::find($product_id);

    if($request->isMethod('post')) {
      $input = $request->all();
      if (!$product->saveProduct($input)) {
        return redirect()->back()->withErrors($product->getValidation())->withInput($input);
      }
      return redirect('admin/product/save/' . $product->product_id)->with('msg', 'Product ' . $action . "d");
    }

    $data['action'] = $action;
    $data['product'] = $product;
    return view('admin/product/form', $data);
  }
  
}