<?php

namespace App\Models\Services;


use App\Models\Company;
use App\Models\Ticket;
use DB;

class TicketService
{
  public function getTicket($ticket_id) {
    $ticket = Ticket::findOrNew($ticket_id);
    $ticket->staff_assignment = DB::table('staff_assignment')->where('ticket_id', $ticket_id)->get();
    $ticket->preferred_datetime = DB::table('ticket_preferred_datetime')->where('ticket_id', $ticket_id)->get();
    return $ticket;
  }
}