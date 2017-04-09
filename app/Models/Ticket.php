<?php namespace App\Models;

use App\Models\Enums\TicketStat;
use Carbon\Carbon;
use Eloquent, DB, Validator, Log;

class Ticket extends Eloquent
{
  public $table = 'ticket';
  protected $primaryKey = 'ticket_id';
  protected $validation;
  public $timestamps = false;

  public function getValidation() {
    return $this->validation;
  }
}