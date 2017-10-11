<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Access;
use App\Models\CategoryForTicket;
use App\Models\PaymentMethod;
use App\Models\Services\AccessService;
use App\Models\Services\TicketService;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
  protected $ticket_service;
  protected $access_service;

  public function __construct(AccessService $access_service, TicketService $ticket_service)
  {
    $this->access_service = $access_service;
    $this->ticket_service = $ticket_service;
  }
  
  public function paymentMethod(Request $request) {
    $payment_methods = PaymentMethod::orderBy("position")->get();
    if($request->isMethod("post")) {
      $input = $request->all();
      $payment_method_service = new PaymentMethod();
      $payment_method_service->savePaymentMethods($payment_methods, $input);
      return redirect("admin/payment-method")->with("msg", "Payment methods updated");
    }
    $data['payment_methods'] = $payment_methods;
    return view("admin/setting/payment-method", $data);
  }
  

  public function setting(Request $request) {
    $data['settings'] = Setting::all();
    return view("admin/setting/setting-index", $data);
  }

  public function access(Request $request) {
    $data['accesses'] = Access::all();
    return view("admin/setting/access-index", $data);
  }

  public function categoryForTicket() {
    $data['categories'] = $this->ticket_service->getCategoryDropdown();
    return view('admin/setting/category-for-ticket', $data);
  }
  
  public function categoryForTicketSave(Request $request, $category_for_ticket_id = null) {
    $action = $category_for_ticket_id == null ? 'create' : 'update';
    $category = $category_for_ticket_id == null ? new CategoryForTicket() : CategoryForTicket::find($category_for_ticket_id);
  
    if($request->isMethod('post')) {
      $input = $request->all();
      if (!$category->saveCategoryForTicket($input)) {
        return redirect()->back()->withErrors($category->getValidation())->withInput($input);
      }
      return redirect('admin/category-for-ticket/save/' . $category->category_for_ticket_id)->with('msg', 'Category for Ticket ' . $action . "d");
    }
  
    $data['action'] = $action;
    $data['category'] = $category;
    return view('admin/setting/category-for-ticket-form', $data);
  }

  public function system() {
    return view('admin/setting/system');
  }

}