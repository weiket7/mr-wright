<?php

use Illuminate\Database\Seeder;

class CategoryForTicketSeeder extends Seeder
{
  public function run()
  {
    DB::table('category_for_ticket')->insert([
      'category_for_ticket_id'=>1,
      'name'=>'Mechanical',
      'updated_by'=>'admin',
      'updated_on'=>date('Y-m-d H:i:s')
    ]);

    DB::table('category_for_ticket')->insert([
      'category_for_ticket_id'=>2,
      'name'=>'Electrical',
      'updated_by'=>'admin',
      'updated_on'=>date('Y-m-d H:i:s')
    ]);

    DB::table('category_for_ticket')->insert([
      'category_for_ticket_id'=>3,
      'name'=>'Plumbing',
      'updated_by'=>'admin',
      'updated_on'=>date('Y-m-d H:i:s')
    ]);
  }
}


