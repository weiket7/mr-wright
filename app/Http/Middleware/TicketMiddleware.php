<?php

namespace App\Http\Middleware;

use App\Models\Enums\Role;
use App\Models\Enums\TicketStat;
use App\Models\Enums\UserType;
use App\Models\Ticket;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Log;

class TicketMiddleware
{ 
  public function handle(Request $request, Closure $next)
  {
    $action = $request->segment(2);
    $ticket_id = $request->id;

    if (Auth::check() == false) {
      $request->session()->put('referrer', "ticket/".$action."/".$ticket_id);
      return redirect("login")->with('msg', 'Please log in');
    }

    $role = $request->user()->role;
    if ($role != Role::Requester) {
      return redirect("error")->with('error', 'Not authorised to accept or decline ticket');
    }

    //if ticket does not belong to the person
    $ticket = Ticket::find($ticket_id);
    if ($role == Role::Requester) {
      $access = $request->session()->get('access');
      if ($access['company_id'] != $ticket->company_id || $access['office_id'] != $ticket->office_id) {
        return redirect("error")->with('error', 'Not authorised to this ticket');
      }
    }

    if($ticket->stat != TicketStat::Quoted) {
      $action_past_tense = $action == 'accept' ? 'accepted' : 'declined';
      return redirect('error')->with('error', 'This ticket cannot be '.$action_past_tense.' because the status is '.strtolower(TicketStat::$values[$ticket->stat]));
    }

    return $next($request);
  }
}
