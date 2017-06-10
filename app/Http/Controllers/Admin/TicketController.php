<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\QuotationMail;
use App\Models\Enums\PaymentMethodStat;
use App\Models\PaymentMethod;
use App\Models\Requester;
use App\Models\Services\CompanyService;
use App\Models\Services\PaymentService;
use App\Models\Services\TicketService;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Models\Helpers\BackendHelper;
use Log;
use Mail;

class TicketController extends Controller
{
  protected $company_service;
  protected $ticket_service;
  
  public function __construct(CompanyService $company_service, TicketService $ticket_service)
  {
    $this->company_service = $company_service;
    $this->ticket_service = $ticket_service;
  }
  
  public function index(Request $request)
  {
    if ($request->isMethod("post")) {
      $input = $request->all();
      $tickets = $this->ticket_service->searchTicket($input);
      $request->flash();
      $data['search_result'] = 'Showing ' . count($tickets) . ' ticket(s)';
    } else {
      $tickets = Ticket::orderBy('updated_on', 'desc')->get();
    }
    $data['tickets'] = $tickets;
    $data['categories'] = $this->ticket_service->getCategoryDropdown();
    return view("admin/ticket/index", $data);
  }
  
  public function save(Request $request, $ticket_id = null)
  {
    $data['action'] = $ticket_id == null ? 'create' : 'update';
    if ($request->isMethod("post")) {
      $input = $request->all();
      $submit_action = $input['submit_action'];
      $result = "";
      if ($submit_action == "quote") {
        $ticket = $this->ticket_service->sendQuotation($ticket_id, $this->getUsername());
        $this->ticket_service->emailQuotation($ticket);
        $result = "Quotation sent";
        return redirect('admin/ticket/view/' . $ticket_id)->with('msg', $result);
      }
      
      if ($submit_action == "open") {
        $ticket_id = $this->ticket_service->openTicket($ticket_id, $this->getUsername());
        $result = "Ticket opened";
      } elseif ($submit_action == "draft" || $submit_action == "update") {
        $ticket_id = $this->ticket_service->saveTicket($ticket_id, $input, $this->getUsername());
        if ($ticket_id === false) {
          return redirect()->back()->withErrors($this->ticket_service->getValidation())->withInput($input);
        }
        $result = "Ticket " . $data['action'] . "d";
      }
      return redirect('admin/ticket/save/' . $ticket_id)->with('msg', $result);
      
    }
    $ticket = $this->ticket_service->getTicket($ticket_id);
    $data['ticket'] = $ticket;
    $data['companies'] = $this->company_service->getCompanyDropdown();
    $data['offices'] = $this->company_service->getOfficeDropdown($ticket->company_id);
    $data['requesters'] = $this->company_service->getRequesterDropdown($ticket->office_id);
    $data['categories'] = $this->ticket_service->getCategoryDropdown();
    $data['skills'] = $this->ticket_service->getSkills();
    
    return view('admin/ticket/form', $data);
  }
  
  public function view(Request $request, $ticket_id = null)
  {
    if ($request->isMethod("post")) {
      $input = $request->all();
      $submit = $input['submit'];
      $result = "";
      if (BackendHelper::stringContains($submit, "accept")) {
        $ticket = $this->ticket_service->acceptTicket($ticket_id, $input, $this->getUsername());
        $this->ticket_service->emailTicketAccept($ticket);
        $result = "Ticket accepted";
      } elseif (BackendHelper::stringContains($submit, "decline")) {
        $this->ticket_service->declineTicket($ticket_id, $input, $this->getUsername());
        $result = "Ticket declined";
      } elseif (BackendHelper::stringContains($submit, "complete")) {
        $this->ticket_service->completeTicket($ticket_id, $this->getUsername());
        $result = "Ticket completed";
      } elseif (BackendHelper::stringContains($submit, "invoice")) {
        $ticket = $this->ticket_service->invoiceTicket($ticket_id, $input, $this->getUsername());
        $this->ticket_service->emailTicketInvoice($ticket);
        $result = "Invoice sent";
      } elseif (BackendHelper::stringContains($submit, "paid")) {
        $this->ticket_service->paidTicket($ticket_id, $input['payment_method'], $input['ref_no'], $this->getUsername());
        $result = "Ticket paid";
      }
      return redirect('admin/ticket/view/' . $ticket_id)->with('msg', $result);
    }
    
    $ticket = $this->ticket_service->getTicket($ticket_id);
    $this->ticket_service->populateTicketForView($ticket);
    $data['action'] = $request->segment(3);
    $data['ticket'] = $ticket;
    $payment_service = new PaymentService();
    $data['payment_methods'] = $payment_service->getPaymentMethods(PaymentMethodStat::Active);
    
    return view("admin/ticket/view", $data);
  }
}