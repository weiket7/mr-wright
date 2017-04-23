<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterExistingUenMail extends Mailable
{
  use Queueable, SerializesModels;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($company_id)
  {
    $this->company_id = $company_id;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {

    return $this->view('frontend/emails/register-existing-uen');
  }
}
