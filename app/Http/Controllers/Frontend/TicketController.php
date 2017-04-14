<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FrontendService;
use App\Models\Services\CompanyService;
use App\Models\Services\TicketService;
use Illuminate\Http\Request;

class TicketController extends Controller
{
  protected $company_service;
  protected $ticket_service;

  public function __construct(CompanyService $company_service, TicketService $ticket_service) {
    $this->company_service = $company_service;
    $this->ticket_service = $ticket_service;
  }

  public function create() {
    $data['categories'] = $this->ticket_service->getCategoryDropdown();

    return view('frontend/ticket-form', $data);
  }

}