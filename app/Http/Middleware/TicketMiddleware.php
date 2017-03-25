<?php

namespace App\Http\Middleware;

use App\Models\Enums\UserType;
use App\Models\Ticket;
use Closure;

class TicketMiddleware
{
  public function handle($request, Closure $next)
  {
    $action = $request->segment(2);
    $user = $request->user();

    if ($request->segment(3) == null) { //index
      return $next($request);
    }

    $ticket_id = $request->id;
    $ticket = Ticket::find($ticket_id);
    if ($ticket == null) {
      return redirect('error')->with('error', 'Ticket does not exist');
    }

    if ($user->type == UserType::Requester && $action == 'save') {
      return redirect('error')->with('error', 'You are not authorised');
    }

    return $next($request);

  }
}
