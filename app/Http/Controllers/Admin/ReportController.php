<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Services\CompanyService;
use App\Models\Services\TicketService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
  protected $company_service;
  protected $ticket_service;

  public function __construct(CompanyService $company_service, TicketService $ticket_service) {
    $this->company_service = $company_service;
    $this->ticket_service = $ticket_service;
  }

  public function ticket()
  {
    $data['companies'] = $this->company_service->getCompanyDropdown();
    $data['categories'] = $this->ticket_service->getCategoryDropdown();
    return view("report/ticket", $data);
  }
  
  
}