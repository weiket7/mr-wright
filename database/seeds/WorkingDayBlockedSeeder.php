<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WorkingDayBlockedSeeder extends Seeder
{
    public function run()
    {
        DB::table('working_day_blocked')->insert([
          'date'=>Carbon::parse('next monday'),
          'updated_by'=>'admin',
          'updated_on'=>Carbon::now()
        ]);
    }
}
