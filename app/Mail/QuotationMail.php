<?php

namespace App\Mail;

use App\Models\Services\TicketService;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuotationMail extends Mailable
{
  use Queueable, SerializesModels;

  public $ticket_id;

  public function __construct($ticket_id)
  {
    $this->ticket_id = $ticket_id;
  }

  public function build(TicketService $ticket_service)
  {
    $ticket = $ticket_service->getTicket($this->ticket_id);
    $subject = "Mr Wright Quotation for ".$ticket->ticket_code;
    $data['ticket'] = $ticket;
    return $this->subject($subject)->view('admin.emails.quotation', $data);
  }
}
