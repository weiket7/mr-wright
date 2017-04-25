<?php

namespace App\Http\Middleware;

use App\Models\Enums\UserType;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Log;


class ModuleMiddleware
{
  public function handle(Request $request, Closure $next)
  {
    $user_type = Auth::user()->type;
    if ($user_type != UserType::Operator) {
      Auth::logout();
      Log::error('ModuleMiddleware - '.Auth::user()->username.' is not operator');
      return redirect("admin/error")->with('error', 'Not authorised');
    }
    
    $module = $request->segment(2);
    Log::info($module);
    if($module == '' || $module == 'api' || $module == 'dashboard') {
      return $next($request);
    }

    $accesses = $request->session()->get('accesses')['accesses'];
    if (! in_array($module, $accesses)) {
      return redirect("admin/error")->with('error', 'Not authorised to module ' . $module);
    }

    return $next($request);
  }
}
