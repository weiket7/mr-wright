<?php

namespace App\Http\Middleware;

use App\Models\Enums\UserType;
use Auth;
use Closure;
use Illuminate\Http\Request;


class ModuleMiddleware
{
  public function handle(Request $request, Closure $next)
  {
    /*$user_type = Auth::user()->type;
    if ($user_type != UserType::Operator) {
      return redirect("admin/error")->with('error', 'Not authorised');
    }
    
    $module = $request->segment(2);
    if($module == 'ticket' || $module == '' || $module == 'api' || $module = 'dashboard') {
      return $next($request);
    }

    $action = $request->segment(2);
    $ticket_id = $request->id;
    $accesses = $request->session()->get('accesses')['accesses'];

    if (! in_array($module, $accesses)) {
      return redirect("admin/error")->with('error', 'Not authorised to module ' . $module);
    }
    /*if (Auth::check() == false) {
      $request->session()->put('referrer', "ticket/" . $action . "/" . $ticket_id);
      return redirect("login")->with('msg', 'Please log in');
    }*/

    return $next($request);
  }
}
