<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TicketPreferredSlotSeeder extends Seeder
{
    public function run()
    {
        DB::table('ticket_preferred_slot')->insert([
          'ticket_id'=>1,
          'date_from'=>Carbon::now()->addDay(2),
          'date_to'=>Carbon::now()->addDay(2),
          'time_from'=>'13:00:00',
          'time_to'=>'15:00:00',
          'updated_by'=>'admin',
          'updated_on'=>date('Y-m-d H:i:s')
        ]);
        
        DB::table('ticket_preferred_slot')->insert([
          'ticket_id'=>1,
          'date_from'=>Carbon::now()->addDay(3),
          'date_to'=>Carbon::now()->addDay(3),
          'time_from'=>'16:00:00',
          'time_to'=>'18:00:00',
          'updated_by'=>'admin',
          'updated_on'=>date('Y-m-d H:i:s')
        ]);
    }
}
