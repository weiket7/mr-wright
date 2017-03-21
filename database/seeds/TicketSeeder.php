<?php

use App\Models\Enums\TicketPriority;
use App\Models\Enums\TicketStat;
use App\Models\Enums\TicketUrgency;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
  public function run()
  {
    $now = Carbon::now();
    $month_year = $now->format('m').$now->format('y');
    DB::table('ticket')->insert([
      'ticket_code'=>'UP_'.$month_year.'_001',
      'stat'=>TicketStat::Opened,
      'title'=>'Fix tap in pantry',
      'company_id'=>1,
      'office_id'=>1,
      'category_id'=>3,
      'category_name'=>'Plumbing',
      'urgency'=> TicketUrgency::High,
      'requester_desc'=>'Inform Sally at reception when done',
      'operator_desc'=>'IMPT: Remember to clean up after completion',

      'drafted_by'=>'Misty',
      'drafted_on'=>Carbon::now(),
      'opened_by'=>'Jessica',
      'opened_on'=>Carbon::now(),
      'requested_by'=>'Sally',
      'requested_on'=>Carbon::now()->addDay(-3),
      'updated_by'=>'admin',
      'updated_on'=>Carbon::now()
    ]);

    DB::table('ticket')->insert([
      'ticket_code'=>'UP_'.$month_year.'_002',
      'stat'=>TicketStat::Opened,
      'title'=>'Fix tap in pantry',
      'company_id'=>1,
      'office_id'=>1,
      'category_id'=>3,
      'category_name'=>'Plumbing',
      'urgency'=> TicketUrgency::High,
      'requester_desc'=>'Inform Sally at reception when done',
      'operator_desc'=>'IMPT: Remember to clean up after completion',

      'drafted_by'=>'Misty',
      'drafted_on'=>Carbon::now(),
      'opened_by'=>'Jessica',
      'opened_on'=>Carbon::now(),
      'requested_by'=>'Sally',
      'requested_on'=>Carbon::now()->addDay(-3),
      'updated_by'=>'admin',
      'updated_on'=>Carbon::now()
    ]);
  }
}
