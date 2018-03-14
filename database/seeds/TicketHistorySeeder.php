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
      ['ticket_id' => 1, 'action' => 'open', 'action_by' => 'Sally', 'action_on' => Carbon::now()],
      ['ticket_id' => 2, 'action' => 'open', 'action_by' => 'Sally', 'action_on' => Carbon::now()],
      ['ticket_id' => 2, 'action' => 'quote', 'action_by' => 'admin', 'action_on' => Carbon::now()],
      
      ['ticket_id' => 3, 'action' => 'open', 'action_by' => 'Sally', 'action_on' => Carbon::now()],
      ['ticket_id' => 3, 'action' => 'quote', 'action_by' => 'admin', 'action_on' => Carbon::now()],
      ['ticket_id' => 3, 'action' => 'accept', 'action_by' => 'Sally', 'action_on' => Carbon::now()],
  
      ['ticket_id' => 4, 'action' => 'open', 'action_by' => 'Sally', 'action_on' => Carbon::now()],
      ['ticket_id' => 4, 'action' => 'quote', 'action_by' => 'admin', 'action_on' => Carbon::now()],
      ['ticket_id' => 4, 'action' => 'decline', 'action_by' => 'Sally', 'action_on' => Carbon::now()],
      
      ['ticket_id' => 5, 'action' => 'open', 'action_by' => 'Sally', 'action_on' => Carbon::now()],
      ['ticket_id' => 5, 'action' => 'quote', 'action_by' => 'admin', 'action_on' => Carbon::now()],
      ['ticket_id' => 5, 'action' => 'accept', 'action_by' => 'Sally', 'action_on' => Carbon::now()],
      ['ticket_id' => 5, 'action' => 'complete', 'action_by' => 'admin', 'action_on' => Carbon::now()],
      
      ['ticket_id' => 6, 'action' => 'open', 'action_by' => 'Sally', 'action_on' => Carbon::now()],
      ['ticket_id' => 6, 'action' => 'quote', 'action_by' => 'admin', 'action_on' => Carbon::now()],
      ['ticket_id' => 6, 'action' => 'accept', 'action_by' => 'Sally', 'action_on' => Carbon::now()],
      ['ticket_id' => 6, 'action' => 'complete', 'action_by' => 'admin', 'action_on' => Carbon::now()],
      ['ticket_id' => 6, 'action' => 'invoice', 'action_by' => 'admin', 'action_on' => Carbon::now()],
      
      ['ticket_id' => 7, 'action' => 'open', 'action_by' => 'Sally', 'action_on' => Carbon::now()],
      ['ticket_id' => 7, 'action' => 'quote', 'action_by' => 'admin', 'action_on' => Carbon::now()],
      ['ticket_id' => 7, 'action' => 'accept', 'action_by' => 'Sally', 'action_on' => Carbon::now()],
      ['ticket_id' => 7, 'action' => 'complete', 'action_by' => 'admin', 'action_on' => Carbon::now()],
      ['ticket_id' => 7, 'action' => 'invoice', 'action_by' => 'admin', 'action_on' => Carbon::now()],
      ['ticket_id' => 7, 'action' => 'indicate_payment', 'action_by' => 'Sally', 'action_on' => Carbon::now()],
      
      ['ticket_id' => 8, 'action' => 'open', 'action_by' => 'Sally', 'action_on' => Carbon::now()],
      ['ticket_id' => 8, 'action' => 'quote', 'action_by' => 'admin', 'action_on' => Carbon::now()],
      ['ticket_id' => 8, 'action' => 'accept', 'action_by' => 'Sally', 'action_on' => Carbon::now()],
      ['ticket_id' => 8, 'action' => 'complete', 'action_by' => 'admin', 'action_on' => Carbon::now()],
      ['ticket_id' => 8, 'action' => 'invoice', 'action_by' => 'admin', 'action_on' => Carbon::now()],
      ['ticket_id' => 8, 'action' => 'indicate_payment', 'action_by' => 'Sally', 'action_on' => Carbon::now()],
      ['ticket_id' => 8, 'action' => 'paid', 'action_by' => 'admin', 'action_on' => Carbon::now()],

    ];
    
    foreach ($data as $d) {
      DB::table('ticket_history')->insert($d);
    }
  }
}
