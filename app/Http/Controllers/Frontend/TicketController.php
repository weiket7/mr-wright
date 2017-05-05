<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Entities\TransactionRequest;
use App\Models\Enums\PaymentMethodStat;
use App\Models\Enums\TransactionStat;
use App\Models\Enums\TransactionType;
use App\Models\FrontendService;
use App\Models\Helpers\BackendHelper;
use App\Models\Requester;
use App\Models\Services\CompanyService;
use App\Models\Services\PaymentService;
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

    $requester = $requester->getRequesterByUsername($this->getUsername());
    $data['requester'] = $requester;
    if ($data['requester']->admin) {
      $data['offices'] = $this->company_service->getOfficeDropdown($requester->company_id);
    }
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
          $this->ticket_service->savePaymentRefNo($ticket_id, $input['ref_no']);
        }

      }
      return redirect('ticket/view/'.$ticket_id)->with('msg', $result);
    }

    $data['action'] = $request->segment(2);
    $data['ticket'] = $ticket;
    $payment_service = new PaymentService();
    $data['payment_methods'] = $payment_service->getPaymentMethods(PaymentMethodStat::Active);
    return view("frontend/ticket-view", $data);
  }


}