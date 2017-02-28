<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WorkingDateTimeBlockedSeeder extends Seeder
{
    public function run()
    {
        DB::table('working_date_time_blocked')->insert([
          'date'=>Carbon::parse('next monday'),
          'time_start'=>'16:00',
          'time_end'=>'19:00',
          'updated_by'=>'admin',
          'updated_on'=>Carbon::now()
        ]);
    }
}
