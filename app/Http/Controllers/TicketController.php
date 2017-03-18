<?php

namespace App\Http\Controllers;

use App;
use App\Models\Services\CompanyService;
use App\Models\Services\TicketService;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Models\Helpers\BackendHelper;

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
    $data['action'] = $ticket_id == null ? 'create' : 'update';
    if($request->isMethod("post")) {
      $input = $request->all();
      $submit = $input['submit'];
      if (BackendHelper::stringContains($submit, "ticket")) {
        if (!$this->ticket_service->saveTicket($ticket_id, $input)) {
          return redirect()->back()->withErrors($this->ticket_service->getValidation())->withInput($input);
        }
        $this->ticket_service->saveStaffAssignments($ticket_id, $input);
        $this->ticket_service->saveTicketIssues($ticket_id, $input);
      } elseif (BackendHelper::stringContains($submit, "quotation")) {
        $this->ticket_service->sendQuotation($ticket_id);

      } elseif (BackendHelper::stringContains($submit, "complete")) {
      $this->ticket_service->completeTicket($ticket_id);
      }
      return redirect()->back()->with('msg', 'Ticket ' . $data['action'] . "d");
    }
    $data['ticket'] = $this->ticket_service->getTicket($ticket_id);
    $data['companies'] = $this->company_service->getCompanyDropdown();
    $data['categories'] = $this->ticket_service->getCategoryDropdown();
    $data['skills'] = $this->ticket_service->getSkills(); 

    return view('ticket/form', $data);
  }

  public function accept(Request $request, $ticket_id = null) {
    //TODO user must log in and ticket must belong to him
    $this->ticket_service->acceptTicket($ticket_id);

  }
  
}