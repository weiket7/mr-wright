<?php

namespace App\Http\Controllers;

use App;
use App\Models\Enums\TicketStat;
use App\Models\Services\CompanyService;
use App\Models\Services\TicketService;
use App\Models\Ticket;
use Auth;
use Illuminate\Http\Request;
use App\Models\Helpers\BackendHelper;
use Log;

class TicketController extends Controller
{
  protected $company_service;
  protected $ticket_service;

  public function __construct(CompanyService $company_service, TicketService $ticket_service) {
    $this->company_service = $company_service;
    $this->ticket_service = $ticket_service;
  }

  public function index(Request $request) {
    if($request->isMethod("post")) {
      $input = $request->all();
      $tickets = $this->ticket_service->searchTicket($input);
      $request->flash();
      $data['search_result'] = 'Showing ' . count($tickets) . ' ticket(s)';
    } else {
      $tickets = Ticket::all(); //TODO
    }
    $data['tickets'] = $tickets;
    $data['categories'] = $this->ticket_service->getCategoryDropdown();
    return view("ticket/index", $data);
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
        $ticket_id = $this->ticket_service->saveTicket($ticket_id, $input);
        if ($ticket_id === false) {
          return redirect()->back()->withErrors($this->ticket_service->getValidation())->withInput($input);
        }
        $result = "Ticket " . $data['action'] . "d";
      } elseif (BackendHelper::stringContains($submit, "quotation")) {
        $this->ticket_service->sendQuotation($ticket_id);
        $result = "Quotation sent";
      } elseif (BackendHelper::stringContains($submit, "complete")) {
        $this->ticket_service->completeTicket($ticket_id);
        $result = "Ticket completed";
      }
      return redirect('ticket/save/'.$ticket_id)->with('msg', $result);
    }
    $ticket = $this->ticket_service->getTicket($ticket_id);
    $data['ticket'] = $ticket;
    $data['companies'] = $this->company_service->getCompanyDropdown();
    $data['offices'] = $this->company_service->getOfficeDropdown($ticket->company_id);
    $data['requesters'] = $this->company_service->getRequesterDropdown($ticket->office_id);
    $data['categories'] = $this->ticket_service->getCategoryDropdown();
    $data['skills'] = $this->ticket_service->getSkills(); 

    return view('ticket/form', $data);
  }

  public function view(Request $request, $ticket_id = null) {
    $ticket = $this->ticket_service->getTicket($ticket_id);
    $action = $request->get('action');
    if($action && $ticket->stat != TicketStat::Quoted) {
      $action_past_tense = $action == 'accept' ? 'accepted' : 'declined';
      return redirect('error')->with('error', 'This ticket cannot be '.$action_past_tense.' because the status is '.strtolower(TicketStat::$values[$ticket->stat]));
    }

    if (Auth::check() == false) {
      $request->session()->put('referrer', "ticket/view/".$ticket_id."?action=".$action);
      return redirect("login")->with('msg', 'Please log in');
    }

    if($request->isMethod("post")) {
      $input = $request->all();
      $submit = $input['submit'];
      $result = "";
      if (BackendHelper::stringContains($submit, "accept")) {
        $this->ticket_service->acceptTicket($ticket_id);
        $result = "Ticket accepted";
      } elseif (BackendHelper::stringContains($submit, "decline")) {
        $this->ticket_service->declineTicket($ticket_id, $input);
        $result = "Ticket declined";
      }
      return redirect('ticket/view/'.$ticket_id)->with('msg', $result);
    }

    $this->ticket_service->populateTicketForView($ticket);
    $data['action'] = $action;
    $data['ticket'] = $ticket;
    return view("ticket/view", $data);
  }
  
}