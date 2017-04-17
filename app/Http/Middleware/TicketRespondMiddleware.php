<?php

namespace App\Http\Middleware;

use App\Models\Enums\TicketStat;
use App\Models\Helpers\BackendHelper;
use App\Models\Services\AccessService;
use App\Models\Ticket;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Log;
use ViewHelper;

class TicketRespondMiddleware
{ 
  public function handle(Request $request, Closure $next)
  {
    $action = $request->segment(3); //admin/ticket/accept or admin/ticket/decline
    $ticket_id = $request->id;

    if (Auth::check() == false) {
      $request->session()->put('referrer', "ticket/".$action."/".$ticket_id);
      return redirect("login")->with('msg', 'Please log in');
    }

    $access_session = BackendHelper::getAccessesFromSession();
    if (! in_array('ticket_respond', $access_session['accesses'])) {
      return redirect("error")->with('error', 'Not authorised to accept or decline ticket');
    }

    $ticket = Ticket::find($ticket_id);
    if($ticket->stat != TicketStat::Quoted) {
      $action_past_tense = $action == 'accept' ? 'accepted' : 'declined';
      return redirect('error')->with('error', 'This ticket cannot be '.$action_past_tense.' because the status is '.strtolower(TicketStat::$values[$ticket->stat]));
    }

    if(! BackendHelper::dateBeforeDateInclusive($ticket->quoted_on, $ticket->quote_valid_till)) {
      $action_past_tense = $action == 'accept' ? 'accepted' : 'declined';
      return redirect('error')->with('error', 'This ticket cannot be '.$action_past_tense.' because the quote has expired, it was valid till '. ViewHelper::formatDate($ticket->quote_valid_till));
    }

    return $next($request);
  }
}
