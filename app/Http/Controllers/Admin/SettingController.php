<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Access;
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

  public function system() {
    return view('admin/setting/system');
  }

}