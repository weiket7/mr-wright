<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\DeleteLog;
use App\Models\Entities\TransactionRequest;
use App\Models\Enums\PaymentMethodStat;
use App\Models\Enums\TicketStat;
use App\Models\Enums\TransactionStat;
use App\Models\Enums\TransactionType;
use App\Models\Helpers\BackendHelper;
use App\Models\Office;
use App\Models\Requester;
use App\Models\Services\PaymentService;
use App\Models\Services\TicketService;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use ViewHelper;

class TicketController extends Controller
{
  protected $ticket_service;

  public function __construct(TicketService $ticket_service) {
    $this->ticket_service = $ticket_service;
  }

  public function index() {
    $data['tickets'] = $this->ticket_service->getTicketAllByUsername($this->getUsername());
    $data['categories'] = $this->ticket_service->getCategoryDropdown();
    $payment_service = new PaymentService();
    $data['payment_methods'] = $payment_service->getPaymentMethods(PaymentMethodStat::Active);
  
    return view('frontend/ticket-index', $data);
  }

  public function save(Request $request, $ticket_id = null) {
    $action = $ticket_id == null ? 'draft' : 'update';
    $ticket = $this->ticket_service->getTicket($ticket_id);
    if(! ViewHelper::ticketCanUpdate($ticket)) {
      return redirect('error')->with('error', "Ticket cannot be updated");
    }
    
    if($request->isMethod("post")) {
      $input = $request->all();
      $submit_action = $input['submit_action'];
  
      if ($input['delete'] == "true") {
        $ticket = Ticket::find($ticket_id);
        $ticket->deleteTicket();
        (new DeleteLog())->saveDeleteLog('ticket', $ticket_id, '', $this->getUsername());
        return redirect('ticket')->with('msg', "Ticket deleted");
      }
      
      $ticket_id = $this->ticket_service->saveFrontendTicket($ticket_id, $input, $this->getUsername());
      if ($ticket_id === false) {
        return redirect()->back()->withErrors($this->ticket_service->getValidation())->withInput($input);
      }
      if (BackendHelper::stringContains($submit_action, "draft") || BackendHelper::stringContains($submit_action, "update")) {
        $result = BackendHelper::stringContains($submit_action, "draft") ? "Ticket drafted" : "Ticket updated";
        return redirect('ticket/save/'.$ticket_id)->with('msg', $result);
      } elseif (BackendHelper::stringContains($submit_action, "open")) {
        $this->ticket_service->openTicket($ticket_id, $this->getUsername());
        return redirect('ticket/view/'.$ticket_id)->with('msg', 'Ticket opened');
      }
    }
    
    if($action == "draft") {
      $ticket->issues = '[{"image":"", "issue_desc":"", "expected_desc":"", "stat":"add"}]';
      $ticket->preferred_slots = '[{"date": "'.Carbon::now()->format('Y-m-d').'", "time_start":"", "time_end":"", "stat":"add"}]';
    }
    $data['ticket'] = $ticket;
    $data['categories'] = $this->ticket_service->getCategoryDropdown();
    $data['action'] = $action;

    $requester = Requester::where('username', $this->getUsername())->first();
    $data['requester'] = $requester;
    $data['office'] = Office::find($requester->office_id);
    $data['company'] = Company::find($requester->company_id);
    return view('frontend/ticket-form', $data);
  }

  public function view(Request $request, $ticket_id = null) {
    $ticket = $this->ticket_service->getTicket($ticket_id);
    if($request->isMethod("post")) {
      $input = $request->all();
      $submit = $input['submit'];
      $result = "";

      if (BackendHelper::stringContains($submit, "accept")) {
        $ticket = $this->ticket_service->acceptTicket($ticket_id, $input, $this->getUsername());
        $this->ticket_service->emailTicketAccept($ticket);
        $result = "Ticket accepted";
      } elseif (BackendHelper::stringContains($submit, "decline")) {
        $this->ticket_service->declineTicket($ticket_id, $input);
        $result = "Ticket declined";
      } elseif (BackendHelper::stringContains($submit, "payment")) {
        $payment_method = $input['payment_method'];
        if ($payment_method == 'R') {
          $transaction_request = new TransactionRequest();
          $transaction_request->code = $ticket->ticket_code;
          $transaction_request->type = TransactionType::Ticket;
          $transaction_request->stat = TransactionStat::Pending;
          $transaction_request->amount = $ticket->quoted_price;
          return redirect('payment')->with('transaction_request', $transaction_request);
        } else if($payment_method == 'B' || $payment_method == 'Q') {
          $this->ticket_service->saveFrontendTicketPayment($ticket_id, $input, $this->getUsername());
          $result = "Payment has been indicated";
        }
      }
      return redirect('ticket/view/'.$ticket_id)->with('msg', $result);
    }

    $data['action'] = $request->segment(2);
    $this->ticket_service->populateTicketForView($ticket);
    $data['ticket'] = $ticket;
    $payment_service = new PaymentService();
    $data['payment_methods'] = $payment_service->getPaymentMethods(PaymentMethodStat::Active);
    if ($ticket->stat == TicketStat::Quoted) {
      $data['quote_valid'] = Carbon::createFromFormat('Y-m-d', $ticket->quote_valid_till)->greaterThanOrEqualTo(Carbon::now() );
    }
    return view("frontend/ticket-view", $data);
  }


}