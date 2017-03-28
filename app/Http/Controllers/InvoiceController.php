<?php

namespace App\Http\Controllers;

use App\Models\Services\CompanyService;
use App\Models\Services\TicketService;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Models\Product;

class InvoiceController extends Controller
{
  protected $company_service;
  protected $ticket_service;

  public function __construct(CompanyService $company_service, TicketService $ticket_service) {
    $this->company_service = $company_service;
    $this->ticket_service = $ticket_service;
  }

  public function index(Request $request)
  {
    if($request->isMethod("post")) {
      $input = $request->all();
      $tickets = $this->ticket_service->searchTicket($input);
      $request->flash();
      $data['search_result'] = 'Showing ' . count($tickets) . ' ticket(s)';
    } else {
      $tickets = Ticket::all(); //TODO
    }
    $data['tickets'] = $tickets;
    $data['companies'] = $this->company_service->getCompanyDropdown();
    $data['categories'] = $this->ticket_service->getCategoryDropdown();
    return view("invoice/index", $data);
  }

}