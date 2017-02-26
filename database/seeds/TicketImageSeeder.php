<?php

use Illuminate\Database\Seeder;

class TicketImageSeeder extends Seeder
{
    public function run()
    {
        DB::table('ticket_image')->insert([
          'ticket_image_id'=>1,
          'ticket_id'=>1,
          'image'=>'lightbulb.jpg',
          'updated_by'=>'admin',
          'updated_on'=>date('Y-m-d H:i:s')
        ]);

        DB::table('ticket_image')->insert([
          'ticket_image_id'=>2,
          'ticket_id'=>1,
          'image'=>'plumbing.jpg',
          'updated_by'=>'admin',
          'updated_on'=>date('Y-m-d H:i:s')
        ]);
    }
}
