<?php

use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
  public function run()
  {
    DB::table('skill')->insert([
      'skill_id'=>1,
      'name'=>'Mechanical',
      'updated_by'=>'admin',
      'updated_on'=>date('Y-m-d H:i:s')
    ]);

    DB::table('skill')->insert([
      'skill_id'=>2,
      'name'=>'Electrical',
      'updated_by'=>'admin',
      'updated_on'=>date('Y-m-d H:i:s')
    ]);

    DB::table('skill')->insert([
      'skill_id'=>3,
      'name'=>'Plumbing',
      'updated_by'=>'admin',
      'updated_on'=>date('Y-m-d H:i:s')
    ]);

    DB::table('skill')->insert([
      'skill_id'=>4,
      'name'=>'Flooring',
      'updated_by'=>'admin',
      'updated_on'=>date('Y-m-d H:i:s')
    ]);
  }
}
