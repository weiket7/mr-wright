<?php

use Illuminate\Database\Seeder;

class TicketImageSeeder extends Seeder
{
    public function run()
    {
        DB::table('ticket')->insert([
          'ticket_image_id'=>1,
          'ticket_id'=>1,
          'image'=>'lightbulb.jpg',
          'updated_by'=>'admin',
          'updated_on'=>date('Y-m-d H:i:s')
        ]);

        DB::table('skill')->insert([
          'staff_skill_id'=>2,
          'skill_id'=>1,
          'staff_id'=>2,
          'name'=>'Electrical',
          'updated_by'=>'admin',
          'updated_on'=>date('Y-m-d H:i:s')
        ]);
    }
}
