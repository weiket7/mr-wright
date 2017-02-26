<?php

use App\Models\Enums\TicketPriority;
use App\Models\Enums\TicketUrgency;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
  public function run()
  {
    DB::table('ticket')->insert([
      'ticket_id'=>1,
      'name'=>'Fix tap in pantry',
      'company_id'=>1,
      'office_id'=>1,
      'requester_id'=>1,
      'urgency'=> TicketUrgency::High,
      'priority'=> TicketPriority::High,
      'requested_on'=>Carbon::now(),
      'updated_by'=>'admin',
      'updated_on'=>date('Y-m-d H:i:s')
    ]);
  }
}
