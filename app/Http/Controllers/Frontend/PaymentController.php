<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Enums\TransactionStat;
use App\Models\Enums\TransactionType;
use App\Models\Registration;
use App\Models\Services\AccessService;
use App\Models\Services\PaymentService;
use App\Models\Services\TicketService;
use App\Models\Setting;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Log;

class PaymentController extends Controller
{
  protected $payment_service;

  public function __construct(PaymentService $payment_service) {
    $this->payment_service = $payment_service;
  }

  public function index(Request $request) {
    $transaction_request = $request->session()->get('transaction_request');
    $this->payment_service->createTransaction($transaction_request);
    $data['transaction_request'] = $transaction_request;
    $data['paydollar_setting'] = Setting::getPaydollarSetting();
    return view('frontend/payment', $data);
  }

  public function callback(Request $request) {
    $src = $request->get('src');
    $prc = $request->get('prc');
    $Ord = $request->get('Ord');
    $Holder = $request->get('Holder');
    $response_code = $request->get('successcode');
    $code = $request->get('Ref');
    $PayRef = $request->get('PayRef');
    $Amt = $request->get('Amt');
    $remark = $request->get('remark');
    $sourceIp = $request->get('sourceIp');
    $ipCountry = $request->get('ipCountry');
    $payMethod = $request->get('payMethod');
    $cardIssuingCountry = $request->get('cardIssuingCountry');
    Log::info('payment/callback - Ref=' . $code . ' Amount='.$Amt . ' successcode=' . $response_code);
    $transaction = $this->payment_service->saveTransaction($code, $response_code);
    if ($transaction->stat == TransactionStat::Success) {
      if ($transaction->type == TransactionType::Registration) {
        $account_service = new Account();
        $registration = Registration::where('registration_code', $code)->first('registration_id');
        $input['office_id'] = $registration->office_id;
        $registration = $account_service->approveRegistration($registration->registration_id, $input);
      } elseif ($transaction->type == TransactionType::Ticket) {
        $ticket_service = new TicketService();
        $ticket_id = Ticket::where('ticket_code', $code)->value('ticket_id');
        $ticket_service->paidTicket($ticket_id, 'Q', $PayRef, $this->getUsername());
      }
    }
    return "OK";
  }

  public function success(Request $request) {
    $code = $request->get('Ref');
    $transaction = $this->payment_service->getTransaction($code);
    if ($transaction->type = TransactionType::Registration) {
      return redirect('register/success');
    }
    if ($transaction->type = TransactionType::Ticket) {
      $ticket_id = Ticket::where('ticket_code', $code)->value('ticket_id');
      return redirect('ticket/view/'.$ticket_id)->with('Ticket paid');
    }
  }

  public function fail(Request $request) {
    $code = $request->get('Ref');
    $data['transaction'] = $this->payment_service->getTransaction($code);
    return view('frontend/payment-fail', $data);
  }

  public function cancel(Request $request) {
    $code = $request->get('Ref');
    $data['transaction'] = $this->payment_service->getTransaction($code);
    return view('frontend/payment-cancel', $data);
  }

}