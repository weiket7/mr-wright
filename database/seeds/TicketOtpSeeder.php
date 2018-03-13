<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TicketOtpSeeder extends Seeder
{
  public function run()
  {
    for($i = 3; $i <= 8; $i++) {
      DB::table('ticket_otp')->insert([
        'ticket_id'=>$i,
        'manual_complete'=>1,
        'first_otp'=>123456,
        'second_otp'=>234567,
      ]);
    }
  }
}
