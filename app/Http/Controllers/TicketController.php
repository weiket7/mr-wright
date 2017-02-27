<?php

namespace App\Http\Controllers;

use App;
use App\Models\Services\CompanyService;
use App\Models\Services\TicketService;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
  protected $company_service;
  protected $ticket_service;

  public function __construct(CompanyService $company_service, TicketService $ticket_service)
  {
    $this->company_service = $company_service;
    $this->ticket_service = $ticket_service;
  }

  public function index()
  {
    $data['tickets'] = Ticket::all();
    return view("ticket/index", $data);
  }
  
  public function save(Request $request, $ticket_id = null) {
    if($request->isMethod("post")) {
      $input = $request->all();
      $this->ticket_service->saveTicket($ticket_id, $input);
    }
    $data['action'] = $ticket_id == null ? 'create' : 'update';
    $data['ticket'] = $this->ticket_service->getTicket($ticket_id);
    $data['companies'] = $this->company_service->getCompanyDropdown();
    $data['categories'] = $this->ticket_service->getCategoryDropdown();
    return view('ticket/form', $data);
  }
  
}