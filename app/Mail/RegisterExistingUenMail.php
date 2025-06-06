<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterExistingUenMail extends Mailable
{
  use Queueable, SerializesModels;
  public $registration;
  public $requester;
  
  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($registration, $requester)
  {
    $this->registration = $registration;
    $this->requester = $requester;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this->subject('Mr Wright - Registration using '.$this->requester->company_name."'s UEN")
      ->view('emails/register-existing-uen');
  }
}
