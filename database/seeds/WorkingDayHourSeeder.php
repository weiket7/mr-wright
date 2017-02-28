<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WorkingDayHourSeeder extends Seeder
{
  public function run()
  {
    DB::table('working_day_hour')->insert([
      'day'=>1,
      'time_from'=>'10:00',
      'time_to'=>'19:00',
      'updated_by'=>'admin',
      'updated_on'=>Carbon::now()
    ]);

    DB::table('working_day_hour')->insert([
      'day'=>2,
      'time_from'=>'10:00',
      'time_to'=>'19:00',
      'updated_by'=>'admin',
      'updated_on'=>Carbon::now()
    ]);

    DB::table('working_day_hour')->insert([
      'day'=>3,
      'time_from'=>'10:00',
      'time_to'=>'19:00',
      'updated_by'=>'admin',
      'updated_on'=>Carbon::now()
    ]);

    DB::table('working_day_hour')->insert([
      'day'=>4,
      'time_from'=>'10:00',
      'time_to'=>'19:00',
      'updated_by'=>'admin',
      'updated_on'=>Carbon::now()
    ]);

    DB::table('working_day_hour')->insert([
      'day'=>5,
      'time_from'=>'10:00',
      'time_to'=>'19:00',
      'updated_by'=>'admin',
      'updated_on'=>Carbon::now()
    ]);

    DB::table('working_day_hour')->insert([
      'day'=>6,
      'time_from'=>'10:00',
      'time_to'=>'13:00',
      'updated_by'=>'admin',
      'updated_on'=>Carbon::now()
    ]);
  }
}
