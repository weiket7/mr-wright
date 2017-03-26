<?php namespace App\Models\Services;

use Carbon\Carbon;
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
}