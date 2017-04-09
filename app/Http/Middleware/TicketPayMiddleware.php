<?php

namespace App\Http\Middleware;

use App\Models\Helpers\BackendHelper;
use App\Models\Services\AccessService;
use Auth;
use Closure;

class TicketPayMiddleware
{
  public function handle($request, Closure $next)
  {
    $action = $request->segment(2);
    $ticket_id = $request->id;

    if (Auth::check() == false) {
      $request->session()->put('referrer', "ticket/".$action."/".$ticket_id);
      return redirect("login")->with('msg', 'Please log in');
    }

    $access_service = new AccessService();

    $access_session = BackendHelper::getAccessesFromSession();
    if (! $access_service->canPayTicket($access_session)) {
      return redirect("error")->with('error', 'Not authorised to accept or decline ticket');
    }

    $ticket = Ticket::find($ticket_id);
    if (! $access_service->isRequesterAndCanAccessTicket(Auth::user(), $access_session, $ticket)) {
      return redirect("error")->with('error', 'Not authorised to this ticket');
    }

    return $next($request);
  }
}
