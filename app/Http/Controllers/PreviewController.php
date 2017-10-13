<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Account;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Invite;
use App\Models\Registration;
use App\Models\Requester;
use App\Models\Services\CompanyService;
use App\Models\Services\TicketService;
use Illuminate\Http\Request;
use Mail;

class PreviewController extends Controller
{
  protected $company_service;
  protected $ticket_service;

  public function __construct(CompanyService $company_service, TicketService $ticket_service) {
    $this->company_service = $company_service;
    $this->ticket_service = $ticket_service;
  }

  public function index() {
    return "<a href='".url('preview/quotation/1')."'>Quotation ?email=true</a><br>".
    "<a href='".url('preview/accept/1')."'>Accept</a><br>".
    "<a href='".url('preview/invoice/1')."'>Invoice</a><br>".
    "<a href='".url('preview/register-existing-uen/1')."'>Register Existing UEN</a><br>".
    "<a href='".url('preview/register-success/1')."'>Register Success</a><br>".
    "<a href='".url('preview/register-approve/1')."'>Register Approve</a><br>";
  }

  public function emailTest() {
    $contact = new Contact();
    $contact->name = 'wei ket';
    $contact->email = 'weiket7@gmail.com';
    $contact->mobile = '9123 4567';
    $contact->message = "abc";
    Mail::to('wei_ket@hotmail.com')->send(new ContactMail($contact));
  }
  
  public function ticketQuotation($ticket_id) {
    $ticket = $this->ticket_service->getTicket($ticket_id);
    $data['ticket'] = $ticket;
    if ($request->get('email') == "true") {
      $this->ticket_service->emailQuotation($ticket);
    }
    return view('emails/quotation', $data);
  }
  
  public function ticketAccept(Request $request, $ticket_id) {
    $ticket = $this->ticket_service->getTicket($ticket_id);
    $this->ticket_service->populateTicketForView($ticket);
    $data['ticket'] = $ticket;
    return view('emails/ticket-accept', $data);
  }

  public function ticketInvoice($ticket_id) {
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

  public function registerSuccess($registration_id) {
    $registration = Registration::findOrFail($registration_id);
    $data['registration'] = $registration;
    return view('emails/registration-success', $data);
  }

  public function registerApprove($registration_id) {
    $registration = Registration::findOrFail($registration_id);
    $data['registration'] = $registration;
    return view('emails/registration-approve', $data);
  }

  public function invite() {
    $input['email'] = 'wei_ket@hotmail.com';
    $input['office_id'] = 1;
    $invite_service = new Invite();
    $invite = $invite_service->saveInvite($input, $this->getUsername());
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