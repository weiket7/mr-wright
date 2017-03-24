<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuotationMail extends Mailable
{
  use Queueable, SerializesModels;
  protected $ticket;

  /**
   * Create a new message instance.
   *
   * @return void
   */

  public function __construct($ticket)
  {
    $this->ticket = $ticket;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    $data['ticket'] = $this->ticket;
    return $this->markdown('emails.quotation', $data);
  }
}
