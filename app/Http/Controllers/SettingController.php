<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\Services\AccessService;
use App\Models\Services\TicketService;
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

  public function role(Request $request) {
    $data['roles'] = $this->access_service->getRoleAll();
    return view("setting/role-index", $data);
  }

  public function access(Request $request) {
    $data['accesses'] = Access::all();
    return view("setting/access-index", $data);
  }

  public function categoryForTicket() {
    $data['categories'] = $this->ticket_service->getCategoryDropdown();
    return view('site/category-for-ticket', $data);
  }

  public function system() {
    return view('site/system');
  }

}