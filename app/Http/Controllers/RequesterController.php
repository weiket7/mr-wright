<?php

namespace App\Http\Controllers;

use App;
use App\Models\Enums\UserType;
use App\Models\User;
use Illuminate\Http\Request;

class RequesterController extends Controller
{
  public function index()
  {
    $data['products'] = User::where('user_type', UserType::Requester)->all();
    return view("product/index", $data);
  }

  public function save(Request $request, $product_id) {
    $data['action'] = $product_id == null ? 'create' : 'update';
    $data['product'] = Product::findOrNew($product_id);
    return view('product/form', $data);
  }

}