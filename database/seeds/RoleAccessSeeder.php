<?php

use App\Models\Enums\Role;
use Illuminate\Database\Seeder;

class RoleAccessSeeder extends Seeder
{
    public function run()
    {
        $ticket_set = [1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8];

        foreach($ticket_set as $t) {
            DB::table('role_access')->insert([
              'role_id'=>1, //admin
              'access_id'=>$t
            ]);
        }

        $arr = $ticket_set;
        unset($arr[4]); //accept
        unset($arr[5]); //decline
        unset($arr[7]); //pay
        foreach($arr as $t) {
            DB::table('role_access')->insert([
              'role_id'=>3, //operator
              'access_id'=>$t
            ]);
        }


        DB::table('role_access')->insert([
          'role_id'=>5, //requester
          'access_id'=>4, //accept
        ]);
        DB::table('role_access')->insert([
          'role_id'=>5, //requester
          'access_id'=>5, //decline
        ]);

        DB::table('role_access')->insert([
          'role_id'=>2, //finance
          'access_id'=>7, //pay
        ]);

    }
}
