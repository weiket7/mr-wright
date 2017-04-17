<?php

namespace App\Http\Middleware;

use App\Models\Services\AccessService;
use App\Models\Ticket;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Log;

class FrontendTicketMiddleware
{
  public function handle(Request $request, Closure $next)
  {
    $module = $request->segment(1);
    $action = $request->segment(2);
    $ticket_id = $request->id;
  
    if ($module == 'ticket' && !empty($action) && !empty($ticket_id)) {
      //Log::info("FrontendTicketMiddleware module=".$module. "action=".$action." ticket_id=".$ticket_id);
      $access_service = new AccessService();
      $ticket = Ticket::find($ticket_id);
      //TODO if admin
      if (! $access_service->requesterCanAccessTicket(Auth::user()->username, $ticket->company_id, $ticket->office_id)) {
        return redirect("error")->with('error', 'Not authorised to this ticket');
      }
    }
    return $next($request);

  }
}
