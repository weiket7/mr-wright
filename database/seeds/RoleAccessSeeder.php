<?php

use App\Models\Enums\Role;
use Illuminate\Database\Seeder;

class RoleAccessSeeder extends Seeder
{
    public function run()
    {
        DB::table('role_access')->insert([
          'role'=>Role::Requester,
          'access_id'=>4, //accept
        ]);
        DB::table('role_access')->insert([
          'role'=>Role::Requester,
          'access_id'=>5, //decline
        ]);
        DB::table('role_access')->insert([
          'role'=>Role::Finance,
          'access_id'=>7, //pay
        ]);
        
    }
}
