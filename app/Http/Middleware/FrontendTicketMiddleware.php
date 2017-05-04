<?php

namespace App\Http\Middleware;

use App\Models\Enums\UserType;
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
      if (Auth::check() == false || Auth::user()->type == UserType::Operator) {
        return redirect('login?referral='.$module.'/'.$action.'/'.$request->id);
      }
      $ticket_id = $request->id;
      $access_service = new AccessService();
      $ticket = Ticket::find($ticket_id);
      if (! $access_service->requesterCanAccessTicket($username, $ticket->company_id, $ticket->office_id)) {
        Log::error('FrontendTicketMiddleware url='.$request->url().' username='.Auth::user()->username.' ticket_id='.$ticket->ticket_id);
        return redirect("error")->with('error', 'Not authorised to this ticket');
      }
    }

    if ($module == 'office'
      || ($module == 'members' && empty($action))
      || ($module == 'members' && $action == 'save')
      || ($module == 'membership' && $action == 'upgrade')) {
      $office_id = $request->id;
      $requester = Requester::where('username', $username)->first();
      if ($requester->admin == false) {
        Log::error('FrontendTicketMiddleware url='.$request->url().' username='.Auth::user()->username.' office_id='.$office_id);
        return redirect("error")->with('error', 'Not authorised to this module');
      }
    }

    return $next($request);
  }
}
