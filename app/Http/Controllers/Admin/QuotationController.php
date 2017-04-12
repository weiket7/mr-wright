<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
  public function __construct(QuotationService $quotation_service)
  {
    $this->quotation_service = $quotation_service;
  }

  public function index()
  {
    $data['tickets'] = [];
    return view("quotation/index", $data);
  }

  public function save(Request $request, $quotation_id) {
    $data['action'] = $quotation_id == null ? 'create' : 'update';
    $data['quotation'] = Quotation::findOrNew($quotation_id);
    return view('quotation/form', $data);
  }

}