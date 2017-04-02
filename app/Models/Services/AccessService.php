<?php namespace App\Models\Services;

use App\Models\Enums\Role;
use App\Models\Requester;
use App\Models\Ticket;
use DB;

class AccessService
{
  public function getRoleAll() {
    $data = DB::table('role_access as ra')->join('access as a', 'ra.access_id', '=', 'a.access_id')->select('role', 'name')->get();
    $res = [];
    foreach($data as $d) {
      $res[$d->role][] = $d->name;
    }
    return $res;
  }

  public function getRoleAccess($role)
  {
    return DB::table('role_access as ra')
      ->where('role', $role)
      ->join('access as a', 'ra.access_id', '=', 'a.access_id')
      ->select('role', 'name')->get();
  }

  public function getAccess($user)
  {
    $company_id = null;
    $office_id = null;
    if ($user->role == Role::Requester) {
      $requester = Requester::where('username', $user->username)->first();
      $company_id = $requester->company_id;
      $office_id = $requester->office_id;
    }
    $access = $this->getRoleAccess($user->role);
    return [
      'role' => $user->role,
      'company_id' => $company_id,
      'office_id' => $office_id,
      'accesses' => $access->pluck('name')->toArray()
    ];
   }

  public function canRespondToTicket($access_session) {
    //respond = accept/decline
    return in_array('ticket_pay', $access_session['accesses']);
  }

  public function isRequesterAndCanAccessTicket($access_session, $ticket_id) {
    if ($access_session['role'] == Role::Requester) {
      $ticket = Ticket::find($ticket_id);
      if ($access_session['company_id'] != $ticket->company_id || $access_session['office_id'] != $ticket->office_id) {
        return false;
      }
    }
    return true;
  }
}