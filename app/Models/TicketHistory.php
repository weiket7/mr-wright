<?php namespace App\Models;

use Eloquent, DB, Validator, Log;

class TicketHistory extends Eloquent
{
  public $table = 'ticket_history';
  protected $primaryKey = 'ticket_history_id';
  protected $validation;
  public $timestamps = false;

}