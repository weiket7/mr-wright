<?php

namespace App\Http\Controllers;

use App;
use App\Models\Quotation;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
  public function index()
  {
    $data['quotations'] = Quotation::all();
    return view("quotation/index", $data);
  }

  public function save(Request $request, $quotation_id) {
    $data['action'] = $quotation_id == null ? 'create' : 'update';
    $data['quotation'] = Quotation::findOrNew($quotation_id);
    return view('quotation/form', $data);
  }

}