<?php

namespace App\Mail;

use App\Models\Services\TicketService;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvoiceMail extends Mailable
{
  use Queueable, SerializesModels;
  protected $ticket;
  
  public $ticket_id;
  
  public function __construct($ticket_id)
  {
    $this->ticket_id = $ticket_id;
  }
  
  public function build(TicketService $ticket_service)
  {
    $ticket = $ticket_service->getTicket($this->ticket_id);
    $data['ticket'] = $ticket;
    $subject = "Mr Wright Invoice for ".$ticket->ticket_code;
    return $this->subject($subject)->markdown('emails.invoice', $data);
  }
}
