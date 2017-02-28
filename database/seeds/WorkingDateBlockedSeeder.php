<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WorkingDateBlockedSeeder extends Seeder
{
    public function run()
    {
        DB::table('working_date_blocked')->insert([
          'date'=>Carbon::parse('next monday'),
          'updated_by'=>'admin',
          'updated_on'=>Carbon::now()
        ]);
    }
}
