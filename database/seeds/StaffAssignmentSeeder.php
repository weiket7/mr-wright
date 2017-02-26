<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class StaffAssignmentSeeder extends Seeder
{
  public function run()
  {
    DB::table('staff_assignment')->insert([
      'staff_assignment_id'=>1,
      'staff_id'=>1,
      'ticket_id'=>1,
      'date_from'=>Carbon::now()->addDay(2),
      'date_to'=>Carbon::now()->addDay(2),
      'time_from'=>'13:00:00',
      'time_to'=>'15:00:00',
      'updated_by'=>'admin',
      'updated_on'=>date('Y-m-d H:i:s')
    ]);

    DB::table('staff_assignment')->insert([
      'staff_assignment_id'=>2,
      'staff_id'=>2,
      'ticket_id'=>1,
      'date_from'=>Carbon::now()->addDay(2),
      'date_to'=>Carbon::now()->addDay(2),
      'time_from'=>'13:00:00',
      'time_to'=>'15:00:00',
      'updated_by'=>'admin',
      'updated_on'=>date('Y-m-d H:i:s')
    ]);
  }
}
