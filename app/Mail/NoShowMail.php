<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NoShowMail extends Mailable
{
  use Queueable, SerializesModels;
  public $no_shows;
  
  public function __construct($no_shows)
  {
    $this->no_shows = $no_shows;
  }
  
  public function build()
  {
    return $this->subject('No Shows')->view('emails.no-show');
  }
}
