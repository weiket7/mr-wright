<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InviteMail extends Mailable
{
  use Queueable, SerializesModels;
  public $token;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($token)
  {
    $this->token = $token;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    $subject = 'Invite to Mr Wright';
    return $this->subject($subject)->view('emails.invite');
  }
}
