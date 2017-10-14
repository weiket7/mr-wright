<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TicketOtpSeeder extends Seeder
{
  public function run()
  {
    DB::table('ticket_otp')->insert([
      'ticket_id'=>3,
      'date'=>Carbon::parse('next thursday'),
      'first_otp'=>123456,
      'second_otp'=>234567,
    ]);
  }
}
