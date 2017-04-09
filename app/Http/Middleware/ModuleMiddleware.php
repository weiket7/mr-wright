<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;


class ModuleMiddleware
{
  public function handle(Request $request, Closure $next)
  {
    $module = $request->segment(1);
    if($module == 'ticket' || $module == '' || $module == 'api') {
      return $next($request);
    }

    $action = $request->segment(2);
    $ticket_id = $request->id;
    $accesses = $request->session()->get('accesses')['accesses'];

    if (! in_array($module, $accesses)) {
      return redirect("error")->with('error', 'Not authorised to module ' . $module);
    }
    /*if (Auth::check() == false) {
      $request->session()->put('referrer', "ticket/" . $action . "/" . $ticket_id);
      return redirect("login")->with('msg', 'Please log in');
    }*/

    return $next($request);
  }
}
