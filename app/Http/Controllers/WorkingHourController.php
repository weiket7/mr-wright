<?php

namespace App\Http\Controllers;

use App\Models\Services\WorkingHourService;
use Illuminate\Http\Request;
use App\Models\Product;

class WorkingHourController extends Controller
{
  protected $working_hour_service;

  public function __construct(WorkingHourService $working_hour_service)
  {
    $this->working_hour_service = $working_hour_service;
  }

  public function workingDaytime() {
    $data['working_day_time']  = $this->working_hour_service->getWorkingDayTime();
    return view("working-hour/working-day-time", $data);
  }

  public function blockedDate() {
    $data['blocked_dates']  = $this->working_hour_service->getBlockedDate();
    return view("working-hour/blocked-date", $data);
  }

  public function blockedDateTime() {
    $data['blocked_date_times']  = $this->working_hour_service->getBlockedDateTime();
    return view("working-hour/blocked-date-time", $data);
  }

  public function save(Request $request, $product_id = null) {
    $action = $product_id == null ? 'create' : 'update';
    $product = $product_id == null ? new Product() : Product::find($product_id);

    if($request->isMethod('post')) {
      $input = $request->all();
      if (!$product->saveProduct($input)) {
        return redirect()->back()->withErrors($product->getValidation())->withInput($input);
      }
      return redirect('product/save/' . $product->product_id)->with('msg', 'Product ' . $action . "d");
    }

    $data['action'] = $action;
    $data['product'] = $product;
    return view('product/form', $data);
  }
  
}