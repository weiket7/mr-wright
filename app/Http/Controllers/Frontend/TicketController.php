<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FrontendService;
use App\Models\Helpers\BackendHelper;
use App\Models\Requester;
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
    $action = $ticket_id == null ? 'draft' : 'update';
    if($request->isMethod("post")) {
      $input = $request->all();
      $submit = $input['submit'];
      if (BackendHelper::stringContains($submit, "draft") || BackendHelper::stringContains($submit, "update")) {
        $ticket_id = $this->ticket_service->saveFrontendTicket($ticket_id, $input, $this->getUsername());
        $result = BackendHelper::stringContains($submit, "draft") ? "Ticket drafted" : "Ticket updated";
        return redirect('ticket/save/'.$ticket_id)->with('msg', $result);
      } elseif (BackendHelper::stringContains($submit, "open")) {
        $this->ticket_service->openTicket($ticket_id);
        return redirect('ticket/view/'.$ticket_id)->with('msg', 'Ticket opened');
      }
    }
    $ticket = $this->ticket_service->getTicket($ticket_id);
    $data['ticket'] = $ticket;
    $data['categories'] = $this->ticket_service->getCategoryDropdown();
    $data['action'] = $action;
    $requester = new Requester();
    $data['requester'] = $requester->getRequesterByUsername($this->getUsername());
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