<?php namespace App\Models;

use App\Models\Enums\TicketStat;
use Carbon\Carbon;
use Eloquent, DB, Validator, Log;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Eloquent
{
  public $table = 'ticket';
  protected $primaryKey = 'ticket_id';
  public $timestamps = false;
  use SoftDeletes;
  
  public function deleteTicket() {
    $this->delete();
    //DB::table('ticket_history')->where('ticket_id', $this->ticket_id)->delete();
    //DB::table('ticket_skill')->where('ticket_id', $this->ticket_id)->delete();
    //DB::table('ticket_issue')->where('ticket_id', $this->ticket_id)->delete();
    //DB::table('ticket_preferred_slot')->where('ticket_id', $this->ticket_id)->delete();
  }
}