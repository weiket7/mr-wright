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
    DB::table('ticket')->insert([
      'ticket_id'=>1,
      'stat'=>TicketStat::Open,
      'title'=>'Fix tap in pantry',
      'company_id'=>1,
      'office_id'=>1,
      'category_id'=>3,
      'category_name'=>'Plumbing',
      'urgency'=> TicketUrgency::High,
      'requester_desc'=>'Inform Sally at reception when done',
      'operator_desc'=>'IMPT: Remember to clean up after completion',

      'opened_by'=>'jessica',
      'opened_on'=>Carbon::now(),
      'requested_by'=>'sally',
      'requested_on'=>Carbon::now()->addDay(-3),
      'updated_by'=>'admin',
      'updated_on'=>Carbon::now()
    ]);
  }
}
