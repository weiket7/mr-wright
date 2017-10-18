<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Services\TicketService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
  protected $ticket_service;

  public function __construct(TicketService $ticket_service) {
    $this->ticket_service = $ticket_service;
  }

  public function ticket()
  {
    $data['companies'] = Company::getCompanyDropdown();
    $data['categories'] = $this->ticket_service->getCategoryDropdown();
    return view("admin/report/ticket", $data);
  }
  
  
}