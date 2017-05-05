<?php

namespace App\Mail;

use App\Models\Services\TicketService;
use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TicketAcceptMail extends Mailable
{
  use Queueable, SerializesModels;
  
  protected $ticket_id;

  public function __construct($ticket_id)
  {
    $this->ticket_id = $ticket_id;
  }
  
  public function build(TicketService $ticket_service)
  {
    $ticket = $ticket_service->getTicket($this->ticket_id);
    $ticket_service->populateTicketForView($ticket);
    $data['ticket'] = $ticket;
    return $this->subject('Mr Wright - Ticket '.$ticket->ticket_code.' Accepted')->view('emails.ticket-accept', $data);
  }
}
