<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegistrationSuccessMail extends Mailable
{
    use Queueable, SerializesModels;
    public $registration;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($registration)
    {
        $this->registration = $registration;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->subject('Mr Wright - Registration Success')
        ->view('emails/registration-success');
    }
}
