<?php

use Illuminate\Database\Seeder;

class StaffSkillSeeder extends Seeder
{
  public function run()
  {
    DB::table('staff_skill')->insert([
      'staff_id'=>1,
      'skill_id'=>1,
      'updated_by'=>'admin',
      'updated_on'=>date('Y-m-d H:i:s')
    ]);
  
    DB::table('staff_skill')->insert([
      'staff_id'=>2,
      'skill_id'=>1,
      'updated_by'=>'admin',
      'updated_on'=>date('Y-m-d H:i:s')
    ]);
  
    DB::table('staff_skill')->insert([
      'staff_id'=>3,
      'skill_id'=>1,
      'updated_by'=>'admin',
      'updated_on'=>date('Y-m-d H:i:s')
    ]);
  
    DB::table('staff_skill')->insert([
      'staff_id'=>3,
      'skill_id'=>2,
      'updated_by'=>'admin',
      'updated_on'=>date('Y-m-d H:i:s')
    ]);
  
    DB::table('staff_skill')->insert([
      'staff_id'=>3,
      'skill_id'=>3,
      'updated_by'=>'admin',
      'updated_on'=>date('Y-m-d H:i:s')
    ]);
  }
}
