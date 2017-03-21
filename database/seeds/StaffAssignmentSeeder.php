<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class StaffAssignmentSeeder extends Seeder
{
  public function run()
  {
    DB::table('staff_assignment')->insert([
      'staff_id'=>1,
      'ticket_id'=>1,
      'ticket_code'=>'UP_0317_001',
      'date'=>Carbon::parse('next tuesday'),
      'time_start'=>'10:00:00',
      'time_end'=>'13:00:00',
      'updated_by'=>'admin',
      'updated_on'=>Carbon::now(),
    ]);

    DB::table('staff_assignment')->insert([
      'staff_id'=>1,
      'ticket_id'=>1,
      'ticket_code'=>'UP_0317_001',
      'date'=>Carbon::parse('next tuesday'),
      'time_start'=>'14:00:00',
      'time_end'=>'15:00:00',
      'updated_by'=>'admin',
      'updated_on'=>Carbon::now(),
    ]);

    DB::table('staff_assignment')->insert([
      'staff_id'=>2,
      'ticket_id'=>1,
      'ticket_code'=>'UP_0317_001',
      'date'=>Carbon::parse('next tuesday'),
      'time_start'=>'10:00:00',
      'time_end'=>'13:00:00',
      'updated_by'=>'admin',
      'updated_on'=>Carbon::now(),
    ]);

    DB::table('staff_assignment')->insert([
      'staff_id'=>1,
      'ticket_id'=>2,
      'ticket_code'=>'UP_0317_002',
      'date'=>Carbon::parse('next tuesday'),
      'time_start'=>'14:00:00',
      'time_end'=>'18:00:00',
      'updated_by'=>'admin',
      'updated_on'=>Carbon::now(),
    ]);

  }
}
