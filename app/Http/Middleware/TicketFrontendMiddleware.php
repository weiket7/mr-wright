<?php

namespace App\Http\Middleware;

use Closure;

class TicketFrontendMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $action = $request->segment(2);
        $ticket_id = $request->id;

        if (Auth::check() == false) {
            $request->session()->put('referrer', "ticket/".$action."/".$ticket_id);
            return redirect("login")->with('msg', 'Please log in');
        }

        $access_service = new AccessService();

        $access_session = BackendHelper::getAccessesFromSession();
        if (! $access_service->canRespondToTicket($access_session)) {
            return redirect("error")->with('error', 'Not authorised to accept or decline ticket');
        }

        $ticket = Ticket::find($ticket_id);
        if (! $access_service->isRequesterAndCanAccessTicket(Auth::user(), $access_session, $ticket)) {
            return redirect("error")->with('error', 'Not authorised to this ticket');
        }

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
