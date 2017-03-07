<?php

use Illuminate\Database\Seeder;

class TicketSkillSeeder extends Seeder
{
  public function run()
  {
    DB::table('ticket_skill')->insert([
      'ticket_id'=>1,
      'skill_id'=>1,
      'updated_by'=>'admin',
      'updated_on'=>date('Y-m-d H:i:s')
    ]);

    DB::table('ticket_skill')->insert([
      'ticket_id'=>1,
      'skill_id'=>2,
      'updated_by'=>'admin',
      'updated_on'=>date('Y-m-d H:i:s')
    ]);
  }
}
