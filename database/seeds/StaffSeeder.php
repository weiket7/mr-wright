<?php

use App\Models\Enums\StaffStat;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
  public function run()
  {
    DB::table('staff')->insert([
      'staff_id'=>1,
      'name'=>'Tom',
      'mobile'=>91234567,
      'email'=>'tom@mrwright.sg',
      'stat'=>StaffStat::Active,
      'updated_by'=>'admin',
      'updated_on'=>date('Y-m-d H:i:s')
    ]);

    DB::table('staff')->insert([
      'staff_id'=>2,
      'name'=>'Jerry',
      'mobile'=>91234567,
      'email'=>'jerry@mrwright.sg',
      'stat'=>StaffStat::Active,
      'updated_by'=>'admin',
      'updated_on'=>date('Y-m-d H:i:s')
    ]);

    DB::table('staff')->insert([
      'staff_id'=>3,
      'name'=>'Sam',
      'mobile'=>91234567,
      'email'=>'sam@mrwright.sg',
      'stat'=>StaffStat::Inactive,
      'updated_by'=>'admin',
      'updated_on'=>date('Y-m-d H:i:s')
    ]);

  }
}
