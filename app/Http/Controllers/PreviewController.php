<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Company;
use App\Models\Registration;
use App\Models\Requester;
use App\Models\Services\CompanyService;
use App\Models\Services\TicketService;
use Illuminate\Http\Request;

class PreviewController extends Controller
{

  protected $company_service;
  protected $ticket_service;

  public function __construct(CompanyService $company_service, TicketService $ticket_service) {
    $this->company_service = $company_service;
    $this->ticket_service = $ticket_service;
  }

  public function previewQuotation($ticket_id) {
    $ticket = $this->ticket_service->getTicket($ticket_id);
    $data['ticket'] = $ticket;
    return view('emails/quotation', $data);
  }

  public function previewInvoice($ticket_id) {
    $ticket = $this->ticket_service->getTicket($ticket_id);
    $this->ticket_service->populateTicketForView($ticket);
    $data['ticket'] = $ticket;
    return view('emails/invoice', $data);
  }

  public function registerExistingUen($registration_id) {
    $registration = Registration::findOrFail($registration_id);
    //var_dump($registration->company_id); exit;
    $data['requester'] = Requester::where('company_id', $registration->company_id)->first();
    $data['registration'] = $registration;
    return view('emails/register-existing-uen', $data);
  }

  public function invite() {
    $account_service = new Account();
    $invite = $account_service->saveInvite('wei_ket@hotmail.com');
    $data['token'] = $invite->token;
    return view('emails/invite', $data);
  }

  public function forgotPassword() {
    $data['email'] = 'wei_ket@hotmail.com';
    $data['name'] = 'Wei Ket';
    $data['new_password'] = str_random(8);
    return view('emails/forgot-password', $data);
  }


}