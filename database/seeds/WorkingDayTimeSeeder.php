<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WorkingDayTimeSeeder extends Seeder
{
  public function run()
  {
    DB::table('working_day_time')->insert([
      'day'=>1,
      'time_start'=>'10:00',
      'time_end'=>'19:00',
      'updated_by'=>'admin',
      'updated_on'=>Carbon::now()
    ]);

    DB::table('working_day_time')->insert([
      'day'=>1,
      'time_start'=>'20:00',
      'time_end'=>'24:00',
      'updated_by'=>'admin',
      'updated_on'=>Carbon::now()
    ]);

    DB::table('working_day_time')->insert([
      'day'=>2,
      'time_start'=>'10:00',
      'time_end'=>'19:00',
      'updated_by'=>'admin',
      'updated_on'=>Carbon::now()
    ]);

    DB::table('working_day_time')->insert([
      'day'=>3,
      'time_start'=>'10:00',
      'time_end'=>'19:00',
      'updated_by'=>'admin',
      'updated_on'=>Carbon::now()
    ]);

    DB::table('working_day_time')->insert([
      'day'=>4,
      'time_start'=>'10:00',
      'time_end'=>'19:00',
      'updated_by'=>'admin',
      'updated_on'=>Carbon::now()
    ]);

    DB::table('working_day_time')->insert([
      'day'=>5,
      'time_start'=>'10:00',
      'time_end'=>'19:00',
      'updated_by'=>'admin',
      'updated_on'=>Carbon::now()
    ]);

    DB::table('working_day_time')->insert([
      'day'=>6,
      'time_start'=>'10:00',
      'time_end'=>'23:00',
      'updated_by'=>'admin',
      'updated_on'=>Carbon::now()
    ]);
  }
}
