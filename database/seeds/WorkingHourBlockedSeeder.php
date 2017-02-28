<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WorkingHourBlockedSeeder extends Seeder
{
    public function run()
    {
        DB::table('working_hour_blocked')->insert([
          'date'=>Carbon::parse('next monday'),
          'time_from'=>'16:00',
          'time_to'=>'19:00',
          'updated_by'=>'admin',
          'updated_on'=>Carbon::now()
        ]);
    }
}
