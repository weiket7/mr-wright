<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\DeleteLog;
use App\Models\Enums\PaymentMethodStat;
use App\Models\Office;
use App\Models\Requester;
use App\Models\Services\PaymentService;
use App\Models\Services\TicketService;
use App\Models\Skill;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Helpers\BackendHelper;
use ViewHelper;

class TicketController extends Controller
{
  protected $ticket_service;
  
  public function __construct(TicketService $ticket_service) {
    $this->ticket_service = $ticket_service;
  }
  
  public function index(Request $request) {
    $input = $request->all();
    if ($request->isMethod("post")) {
      $request->flash();
    } else {
      $input["limit"] = 100;
    }
    
    $data['tickets'] = $this->ticket_service->searchTicket($input);
    $data['search_result'] = 'Showing ' . count($data['tickets']) . ' ticket(s)';
    $data['categories'] = $this->ticket_service->getCategoryDropdown();
    return view("admin/ticket/index", $data);
  }
  
  public function save(Request $request, $ticket_id = null) {
    $data['action'] = $ticket_id == null ? 'create' : 'update';
    $ticket = $this->ticket_service->getTicket($ticket_id);
    if(! ViewHelper::ticketCanUpdateAdmin($ticket)) {
      return redirect('admin/error')->with('error', "Ticket cannot be updated");
    }
    
    if ($request->isMethod("post")) {
      $input = $request->all();
      $submit_action = $input['submit_action'];
      $result = "";
  
      if ($input['delete'] == "true") {
        $ticket = Ticket::find($ticket_id);
        $ticket->deleteTicket();
        (new DeleteLog())->saveDeleteLog('ticket', $ticket_id, '', $this->getUsername());
        return redirect('admin/ticket')->with('msg', "Ticket deleted");
      }
  
      $ticket_id = $this->ticket_service->saveTicket($ticket_id, $input);
      if ($ticket_id === false) {
        return redirect()->back()->withErrors($this->ticket_service->getValidation())->withInput($input);
      }
      if ($submit_action == "quote") {
        $ticket = $this->ticket_service->quoteTicket($ticket_id, $input, $this->getUsername());
        if ($ticket == false) {
          return redirect()->back()->withErrors($this->ticket_service->getValidation())->withInput($input);
        }
        $this->ticket_service->emailQuotation($ticket);
        $result = "Quotation sent";
        return redirect('admin/ticket/view/' . $ticket_id)->with('msg', $result);
      } else if ($submit_action == "open") {
        $this->ticket_service->openTicket($ticket_id, $this->getUsername());
        $result = "Ticket opened";
      } elseif ($submit_action == "draft" || $submit_action == "update") {
        $result = "Ticket " . $data['action'] . "d";
      }
      return redirect('admin/ticket/save/' . $ticket_id)->with('msg', $result);
    }
  
    if($data['action'] == "create") {
      $ticket->issues = '[{"image":"", "issue_desc":"", "expected_desc":"", "stat":"add"}]';
      $ticket->preferred_slots = '[{"date": "'.Carbon::now()->format('Y-m-d').'", "time_start":"", "time_end":"", "stat":"add"}]';
    }
    $data['ticket'] = $ticket;
    $data['companies'] = Company::getCompanyDropdown();
    $data['offices'] = Office::getOfficeDropdown($ticket->company_id);
    $data['requesters'] = Requester::getRequesterDropdown($ticket->office_id);
    $data['categories'] = $this->ticket_service->getCategoryDropdown();
    $data['skills'] = Skill::orderBy('name')->pluck('name', 'skill_id');
    
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
        $this->ticket_service->ticketOtpManualComplete($ticket_id);
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