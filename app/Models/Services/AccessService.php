<?php namespace App\Models\Services;

use App\Models\Access;
use App\Models\Enums\Role;
use App\Models\Enums\UserType;
use App\Models\Requester;
use App\Models\Ticket;
use DB;

class AccessService
{
  public function getRoleAll() {
    $data = DB::table('role_access as ra')->join('access as a', 'ra.access_id', '=', 'a.access_id')->select('role_id', 'name')->get();
    $res = [];
    foreach($data as $d) {
      $res[$d->role][] = $d->name;
    }
    return $res;
  }

  public function getRoleAccess($role_id)
  {
    return DB::table('role_access as ra')
      ->where('role_id', $role_id)
      ->join('access as a', 'ra.access_id', '=', 'a.access_id')
      ->select('name', 'ra.access_id')->get()->keyBy('access_id');
  }

  public function getAccess($user)
  {
    $company_id = null;
    $office_id = null;
    //TODO
    /*if ($user->role == Role::Requester) {
      $requester = Requester::where('username', $user->username)->first();
      $company_id = $requester->company_id;
      $office_id = $requester->office_id;
    }*/
    $access = $this->getRoleAccess($user->role_id);
    return [
      'company_id' => $company_id,
      'office_id' => $office_id,
      'accesses' => $access->pluck('name')->toArray()
    ];
   }

  public function canRespondToTicket($access_session) {
    return in_array('ticket_respond', $access_session['accesses']);
  }

  public function requesterCanAccessTicket($username, $company_id, $office_id) {
    $requester_service = new Requester();
    $requester = $requester_service->getRequesterByUsername($username);
  
    if ($requester->is_admin && $requester->company_id == $company_id) {
      return true;
    }
    
    if ($requester->company_id == $company_id && $requester->office_id == $office_id) {
      return true;
    }
    return false;
  }

  public function getAvailableAccess($role_accesses) {
    $all_accesses = Access::select(['name', 'access_id'])->get()->keyBy('access_id');
    $available_accesses = $all_accesses->diffKeys($role_accesses)->all();
    //var_dump($available_accesses); exit;
    return $available_accesses;
  }
}