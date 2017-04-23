<?php

namespace App\Http\Middleware;

use App\Models\Registration;
use App\Models\Requester;
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

    $username = Auth::user()->username;

    if ($module == 'ticket' && !empty($action) && !empty($request->id)) {
      $ticket_id = $request->id;
      $access_service = new AccessService();
      $ticket = Ticket::find($ticket_id);
      if (! $access_service->requesterCanAccessTicket($username, $ticket->company_id, $ticket->office_id)) {
        Log::error('FrontendTicketMiddleware url='.$request->url().' username='.Auth::user()->username.' ticket_id='.$ticket->ticket_id);
        return redirect("error")->with('error', 'Not authorised to this ticket');
      }
    }

    if ($module == 'office') {
      $office_id = $request->id;
      $requester = Requester::where('username', $username)->first();
      if ($requester->admin == false) {
        Log::error('FrontendTicketMiddleware url='.$request->url().' username='.Auth::user()->username.' office_id='.$office_id);
        return redirect("error")->with('error', 'Not authorised to this office');
      }
    }

    if ($module == 'invite' && $action == 'registration' && !empty($request->id)) {
      $registration_id = $request->id;
      $registration = Registration::findOrFail($registration_id);
      $requester = Requester::where('username', $username)->first();
      if ($requester->company_id != $registration->company_id) {
        Log::error('FrontendTicketMiddleware url='.$request->url().' username='.Auth::user()->username.' registration_id='.$registration->registration_id);
        return redirect("error")->with('error', 'Not authorised to this registration');
      }
    }
    return $next($request);

  }
}
