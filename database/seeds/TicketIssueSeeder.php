<?php

use Illuminate\Database\Seeder;

class TicketIssueSeeder extends Seeder
{
  public function run()
  {
    DB::table('ticket_issue')->insert([
      'ticket_id'=>1,
      'image'=>'lightbulb.jpg',
      'issue_desc'=>'',
      'expected_desc'=>'',
    ]);
    
    DB::table('ticket_issue')->insert([
      'ticket_id'=>1,
      'image'=>'plumbing.jpg',
      'issue_desc'=>'No water',
      'expected_desc'=>'Replace with lever tap handle',
    ]);
  }
}
