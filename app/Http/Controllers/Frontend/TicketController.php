<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FrontendService;
use App\Models\Helpers\BackendHelper;
use App\Models\Services\CompanyService;
use App\Models\Services\TicketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;

class TicketController extends Controller
{
  protected $company_service;
  protected $ticket_service;

  public function __construct(CompanyService $company_service, TicketService $ticket_service) {
    $this->company_service = $company_service;
    $this->ticket_service = $ticket_service;
  }

  public function index() {
    $data['tickets'] = $this->ticket_service->getTicketAllByUsername(Auth::user()->username);
    $data['categories'] = $this->ticket_service->getCategoryDropdown();

    return view('frontend/ticket-index', $data);
  }

  public function save(Request $request, $ticket_id = null) {
    $data['action'] = $ticket_id == null ? 'create' : 'update';
    if($request->isMethod("post")) {
      $input = $request->all();
      $submit = $input['submit'];
      $result = "";
      if (BackendHelper::stringContains($submit, "open ticket")) {
        $this->ticket_service->openTicket($ticket_id);
        $result = "Ticket opened";
      } elseif (BackendHelper::stringContains($submit, "ticket")) {
        $ticket_id = $this->ticket_service->saveTicket($ticket_id, $input, $this->getUsername());
        if ($ticket_id === false) {
          return redirect()->back()->withErrors($this->ticket_service->getValidation())->withInput($input);
        }
        $result = "Ticket " . $data['action'] . "d";
      } elseif (BackendHelper::stringContains($submit, "quotation")) {
        $this->ticket_service->sendQuotation($ticket_id, $this->getUsername());
        $result = "Quotation sent";
      }
      return redirect('ticket/save/'.$ticket_id)->with('msg', $result);
    }
    $ticket = $this->ticket_service->getTicket($ticket_id);
    $data['categories'] = $this->ticket_service->getCategoryDropdown();
    $data['ticket'] = $ticket;
    return view('frontend/ticket-form', $data);
  }

  public function view(Request $request, $ticket_id = null) {
    if($request->isMethod("post")) {
      $input = $request->all();
      $submit = $input['submit'];
      $result = "";
      if (BackendHelper::stringContains($submit, "accept")) {
        $this->ticket_service->acceptTicket($ticket_id, $input, $this->getUsername());
        $result = "Ticket accepted";
      } elseif (BackendHelper::stringContains($submit, "decline")) {
        $this->ticket_service->declineTicket($ticket_id, $input);
        $result = "Ticket declined";
      } elseif (BackendHelper::stringContains($submit, "payment")) {
        $this->ticket_service->paidTicket($input, $ticket_id, $this->getUsername());
        $result = "Ticket paid";
      }
      return redirect('ticket/view/'.$ticket_id)->with('msg', $result);
    }

    $ticket = $this->ticket_service->getTicket($ticket_id);
    $this->ticket_service->populateTicketForView($ticket);
    $data['action'] = $request->segment(2);
    $data['ticket'] = $ticket;
    return view("frontend/ticket-view", $data);
  }


}