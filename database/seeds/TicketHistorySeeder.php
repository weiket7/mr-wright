<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TicketHistorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $data = [
      ['ticket_id' => 1, 'action' => 'open', 'action_by' => 'Jessica', 'action_on' => Carbon::now()],
      ['ticket_id' => 2, 'action' => 'open', 'action_by' => 'Jessica', 'action_on' => Carbon::now()]
    ];
    
    foreach ($data as $d) {
      DB::table('ticket_history')->insert($d);
    }
  }
}
