<?php

namespace App\Http\Controllers;

use App;
use App\Models\Operator;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
  public function index()
  {
    $data['operators'] = Operator::all();
    return view("operator/index", $data);
  }

  public function save(Request $request, $product_id) {
    $data['action'] = $product_id == null ? 'create' : 'update';
    $data['product'] = Product::findOrNew($product_id);
    return view('product/form', $data);
  }

}