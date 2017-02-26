<?php

namespace App\Http\Controllers;

use App;
use App\Models\Services\CompanyService;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
  protected $company_service;

  public function __construct(CompanyService $company_service)
  {
    $this->company_service = $company_service;
  }

  public function index()
  {
    $data['tickets'] = Ticket::all();
    return view("ticket/index", $data);
  }
  
  public function save(Request $request, $ticket_id = null) {
    $data['action'] = $ticket_id == null ? 'create' : 'update';
    $data['ticket'] = Ticket::findOrNew($ticket_id);
    $data['companies'] = $this->company_service->getCompanyDropdown();
    return view('ticket/form', $data);
  }
  
}