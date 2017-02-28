<?php

namespace App\Models\Services;

use App\Models\CategoryForTicket;
use App\Models\Enums\TicketStat;
use App\Models\Quotation;
use App\Models\Ticket;
use Carbon\Carbon;
use DB;

class TicketService
{
  public function getTicket($ticket_id) {
    $ticket = Ticket::findOrNew($ticket_id);
    $ticket->issues = DB::table('ticket_issue')->where('ticket_id', $ticket_id)->get();
    $ticket->staff_assignments = DB::table('staff_assignment')->where('ticket_id', $ticket_id)->get();
    $ticket->preferred_datetimes = DB::table('ticket_preferred_datetime')->where('ticket_id', $ticket_id)->get();
    $ticket->quotation = Quotation::firstOrNew(['ticket_id'=>$ticket_id]);
    //var_dump($ticket->quotation); exit;
    return $ticket;
  }

  public function getCategoryDropdown() {
    return CategoryForTicket::pluck('name', 'category_for_ticket_id');
  }

  public function saveTicket($ticket_id, $input, $operator_username = 'admin') //TODO
  {
    $ticket = Ticket::findOrNew($ticket_id);
    $ticket->title = $input['title'];
    $ticket->category_id = $input['category_id'];
    $ticket->urgency = $input['urgency'];
    $ticket->company_id = $input['company_id'];
    $ticket->office_id = $input['office_id'];
    $ticket->requester_desc = $input['requester_desc'];
    $ticket->operator_desc = $input['operator_desc'];
    $ticket->requested_by = $input['requested_by'];
    $ticket->requested_on = Carbon::createFromFormat('d-m-Y', $input['requested_on']);
    if ($ticket_id == null) {
      $ticket->stat = TicketStat::Open;
      $ticket->opened_by = $operator_username;
      $ticket->opened_on = Carbon::now();
    }
    return $ticket->save();
  }
}