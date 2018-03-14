<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMail extends Mailable
{
  use Queueable, SerializesModels;
  public $contact;
  
  public function __construct(Contact $contact)
  {
    $this->contact = $contact;
  }
  
  public function build() {
    $subject = $this->contact->source == "Contact Us" ? 'Enquiry from '.$this->contact->name : $this->contact->source;
    
    return $this->subject($subject)
      ->view('emails/contact');
  }
}
