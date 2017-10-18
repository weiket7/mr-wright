<?php

namespace App\Http\Middleware;

use App;
use App\Models\Enums\CompanyStat;
use App\Models\Enums\OfficeStat;
use App\Models\Enums\RequesterStat;
use App\Models\Enums\UserType;
use App\Models\Requester;
use App\Models\Services\AccessService;
use App\Models\Ticket;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Log;

class FrontendMiddleware
{
  public function handle(Request $request, Closure $next)
  {
    $module = $request->segment(1);
    $action = $request->segment(2);

    $username = Auth::user()->username;

    if (Auth::check() == false || Auth::user()->type == UserType::Operator) {
      return redirect('login?referral='.$this->getReferral($request));
    }

    $requester_service = new Requester();
    $requester = $requester_service->getRequesterByUsername($username);
    if ($requester->company_stat == CompanyStat::Inactive
      || $requester->office_stat == OfficeStat::Inactive
      || $requester->stat == RequesterStat::Inactive
      || $requester->stat == RequesterStat::Delete) {
      Log::error('FrontendMiddleware account deactivated, username=' . $requester->username);
      return redirect("error")->with('error', "The account has been deactivated");
    }
  
    if ($module == 'ticket' && !empty($action) && !empty($request->id)) {
      $ticket_id = $request->id;
      $access_service = new AccessService();
      $ticket = Ticket::find($ticket_id);
      if (! $access_service->requesterCanAccessTicket($requester, $ticket->company_id, $ticket->office_id)) {
        Log::error('FrontendMiddleware not authorised to ticket, username='.$username.' ticket_id='.$ticket->ticket_id);
        return redirect("error")->with('error', 'Not authorised to this ticket');
      }
    }

    if ($module == 'office'
      || ($module == 'members')
      || ($module == 'membership' && $action == 'upgrade')) {
      $office_id = $request->id;
      if ($requester->admin == false) {
        Log::error('FrontendMiddleware not admin, username='.$username.' module='.$module. ' action='.$action);
        return redirect("error")->with('error', 'Not authorised to this module');
      }
    }

    return $next($request);
  }

  private function getReferral(Request $request) {
    $requestUri = $request->getRequestUri();
    if (App::environment("local")) {
      $start = strlen("mrwright/")+1;
      return substr($requestUri, $start);
    }
    return $requestUri;
  }
}
