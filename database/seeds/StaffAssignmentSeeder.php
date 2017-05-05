<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class StaffAssignmentSeeder extends Seeder
{
  public function run()
  {
    DB::table('staff_assignment')->insert([
      'staff_id'=>1,
      'staff_name'=>'Tom',
      'staff_mobile'=>'91234567',
      'ticket_id'=>1,
      'ticket_code'=>'UP_0317_001',
      'date'=>Carbon::parse('next tuesday'),
      'time_start'=>'10:00:00',
      'time_end'=>'13:00:00',
    ]);

    DB::table('staff_assignment')->insert([
      'staff_id'=>1,
      'staff_name'=>'Tom',
      'staff_mobile'=>'91234567',
      'ticket_id'=>1,
      'ticket_code'=>'UP_0317_001',
      'date'=>Carbon::parse('next wednesday'),
      'time_start'=>'14:00:00',
      'time_end'=>'15:00:00',
    ]);

    DB::table('staff_assignment')->insert([
      'staff_id'=>2,
      'staff_name'=>'Jerry',
      'staff_mobile'=>'91234567',
      'ticket_id'=>1,
      'ticket_code'=>'UP_0317_001',
      'date'=>Carbon::parse('next tuesday'),
      'time_start'=>'10:00:00',
      'time_end'=>'13:00:00',
    ]);

    DB::table('staff_assignment')->insert([
      'staff_id'=>1,
      'staff_name'=>'Tom',
      'staff_mobile'=>'91234567',
      'ticket_id'=>2,
      'ticket_code'=>'UP_0317_002',
      'date'=>Carbon::parse('next tuesday'),
      'time_start'=>'14:00:00',
      'time_end'=>'18:00:00',
    ]);

  }
}
