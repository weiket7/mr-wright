<?php

use App\Models\Enums\Role;
use Illuminate\Database\Seeder;

class RoleAccessSeeder extends Seeder
{
  public function run()
  {
    $ticket_set = [];
    for($i=1; $i<=9; $i++) {
      $ticket_set[$i] = $i;
    }
    $module_set = [];
    for($i=10; $i<=24; $i++) {
      $module_set[$i] = $i;
    }

    foreach($ticket_set as $t) {
      DB::table('role_access')->insert([
        'role_id'=>1, //admin
        'access_id'=>$t
      ]);
    }
    foreach($module_set as $t) {
      DB::table('role_access')->insert([
        'role_id'=>1, //admin
        'access_id'=>$t
      ]);
    }

    $arr = $ticket_set;
    unset($arr[5]); //respond
    unset($arr[8]); //pay
    foreach($arr as $t) {
      DB::table('role_access')->insert([
        'role_id'=>3, //operator
        'access_id'=>$t
      ]);
    }


    DB::table('role_access')->insert([
      'role_id'=>5, //requester
      'access_id'=>5, //respond
    ]);

    DB::table('role_access')->insert([
      'role_id'=>2, //finance
      'access_id'=>8, //pay
    ]);

  }
}
