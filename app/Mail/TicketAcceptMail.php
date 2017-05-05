<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TicketAcceptMail extends Mailable
{
  use Queueable, SerializesModels;
  
  public function __construct($ticket_id)
  {
    $this->ticket = Ticket::find($ticket_id);
  }
  
  public function build()
  {
    return $this->subject('Mr Wright Ticket '.$this->ticket->ticket_code.' first OTP')->view('emails.ticket-accept');
  }
}
