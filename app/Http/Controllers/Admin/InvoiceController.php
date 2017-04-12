<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enums\TicketStat;
use App\Models\Services\CompanyService;
use App\Models\Services\TicketService;
use App\Models\Ticket;
use Illuminate\Http\Request;

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
    $tickets = Ticket::where('stat', TicketStat::Completed)->get();
    $data['tickets'] = $tickets;
    $data['companies'] = $this->company_service->getCompanyDropdown();
    $data['categories'] = $this->ticket_service->getCategoryDropdown();
    return view("admin/invoice/index", $data);
  }

}