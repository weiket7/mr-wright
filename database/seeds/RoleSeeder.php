<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('role')->insert([
      'role_id'=>1,
      'name'=>'Admin',
      'updated_by'=>'admin',
      'updated_on'=>Carbon::now()
    ]);
    DB::table('role')->insert([
      'role_id'=>2,
      'name'=>'Finance',
      'updated_by'=>'admin',
      'updated_on'=>Carbon::now()
    ]);
    DB::table('role')->insert([
      'role_id'=>3,
      'name'=>'Operator',
      'updated_by'=>'admin',
      'updated_on'=>Carbon::now()
    ]);
    DB::table('role')->insert([
      'role_id'=>4,
      'name'=>'Staff',
      'updated_by'=>'admin',
      'updated_on'=>Carbon::now()
    ]);
    DB::table('role')->insert([
      'role_id'=>5,
      'name'=>'Requester',
      'updated_by'=>'admin',
      'updated_on'=>Carbon::now()
    ]);
  }
}
