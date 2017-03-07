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
      'updated_by'=>'admin',
      'updated_on'=>date('Y-m-d H:i:s')
    ]);
    
    DB::table('ticket_issue')->insert([
      'ticket_id'=>1,
      'image'=>'plumbing.jpg',
      'issue_desc'=>'No water',
      'expected_desc'=>'Replace with lever tap handle',
      'updated_on'=>date('Y-m-d H:i:s')
    ]);
  }
}
