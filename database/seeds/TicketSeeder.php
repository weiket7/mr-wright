<?php

use App\Models\Enums\TicketPriority;
use App\Models\Enums\TicketStat;
use App\Models\Enums\TicketUrgency;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class  TicketSeeder extends Seeder
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
      'company_name'=>'Unity Pharmacy',
      'office_id'=>1,
      'office_name'=>'Tampines Outlet',
      'office_addr'=>'Address',
      'office_postal'=>'123456',
      'category_id'=>3,
      'category_name'=>'Plumbing',
      'urgency'=> TicketUrgency::High,
      'quoted_price'=>100,
      'requester_desc'=>'Inform Sally at reception when done',
      'operator_desc'=>'IMPT: Remember to clean up after completion',

      'requested_by'=>'Sally',
      'requester_mobile'=>'9123 4567',
      'requester_email'=>'sally@unity-pharmacy.com',
      'requested_on'=>Carbon::now()->subMinute(99),
      
    ]);

    DB::table('ticket')->insert([
      'ticket_code'=>'UP_'.$month_year.'_002',
      'stat'=>TicketStat::Quoted,
      'title'=>'Fix tap in pantry',
      'company_id'=>1,
      'office_id'=>1,
      'office_addr'=>'Address',
      'office_postal'=>'123456',
      'category_id'=>3,
      'urgency'=> TicketUrgency::High,
      'quoted_price'=>100,
      'requester_desc'=>'Inform Sally at reception when done',
      'operator_desc'=>'IMPT: Remember to clean up after completion',
      'requested_by'=>'Sally',
      'requester_mobile'=>'9123 4567',
      'requester_email'=>'sally@unity-pharmacy.com',
      'requested_on'=>Carbon::now()->subMinute(98),
      'quote_valid_till'=>Carbon::now()->addWeekday(7),
    ]);

    DB::table('ticket')->insert([
      'ticket_code'=>'UP_'.$month_year.'_003',
      'stat'=>TicketStat::Accepted,
      'title'=>'Fix tap in pantry',
      'company_id'=>1,
      'office_id'=>1,
      'office_addr'=>'Address',
      'office_postal'=>'123456',
      'category_id'=>3,
      'urgency'=> TicketUrgency::High,
      'quoted_price'=>120,
      'requester_desc'=>'Inform Sally at reception when done',
      'operator_desc'=>'IMPT: Remember to clean up after completion',
      'requested_by'=>'Sally',
      'requester_mobile'=>'9123 4567',
      'requester_email'=>'sally@unity-pharmacy.com',
      'requested_on'=>Carbon::now()->subMinute(97),
    ]);

    DB::table('ticket')->insert([
      'ticket_code'=>'UP_'.$month_year.'_004',
      'stat'=>TicketStat::Declined,
      'accept_decline_reason'=>'Too expensive',
      'title'=>'Fix tap in pantry',
      'company_id'=>1,
      'office_id'=>1,
      'office_addr'=>'Address',
      'office_postal'=>'123456',
      'category_id'=>3,
      'urgency'=> TicketUrgency::High,
      'quoted_price'=>120,
      'requester_desc'=>'Inform Sally at reception when done',
      'operator_desc'=>'IMPT: Remember to clean up after completion',
      'requested_by'=>'Sally',
      'requester_mobile'=>'9123 4567',
      'requester_email'=>'sally@unity-pharmacy.com',
      'requested_on'=>Carbon::now()->subMinute(96),
    ]);

    DB::table('ticket')->insert([
      'ticket_code'=>'UP_'.$month_year.'_005',
      'stat'=>TicketStat::Completed,
      'title'=>'Fix tap in pantry',
      'company_id'=>1,
      'office_id'=>1,
      'office_addr'=>'Address',
      'office_postal'=>'123456',
      'category_id'=>3,
      'urgency'=> TicketUrgency::High,
      'quoted_price'=>120,
      'requester_desc'=>'Inform Sally at reception when done',
      'operator_desc'=>'IMPT: Remember to clean up after completion',
      'requested_by'=>'Sally',
      'requester_mobile'=>'9123 4567',
      'requester_email'=>'sally@unity-pharmacy.com',
      'requested_on'=>Carbon::now()->subMinute(95),
    ]);


    DB::table('ticket')->insert([
      'ticket_code'=>'UP_'.$month_year.'_006',
      'stat'=>TicketStat::Invoiced,
      'title'=>'Fix tap in pantry',
      'company_id'=>1,
      'office_id'=>1,
      'office_addr'=>'Address',
      'office_postal'=>'123456',
      'category_id'=>3,
      'urgency'=> TicketUrgency::High,
      'quoted_price'=>120,
      'requester_desc'=>'Inform Sally at reception when done',
      'operator_desc'=>'IMPT: Remember to clean up after completion',
      'requested_by'=>'Sally',
      'requester_mobile'=>'9123 4567',
      'requester_email'=>'sally@unity-pharmacy.com',
      'requested_on'=>Carbon::now()->subMinute(94),
    ]);

    DB::table('ticket')->insert([
      'ticket_code'=>'UP_'.$month_year.'_007',
      'stat'=>TicketStat::Paid,
      'title'=>'Fix tap in pantry',
      'company_id'=>1,
      'office_id'=>1,
      'office_addr'=>'Address',
      'office_postal'=>'123456',
      'category_id'=>3,
      'urgency'=> TicketUrgency::High,
      'quoted_price'=>120,
      'requester_desc'=>'Inform Sally at reception when done',
      'operator_desc'=>'IMPT: Remember to clean up after completion',
      'requested_by'=>'Sally',
      'requester_mobile'=>'9123 4567',
      'requester_email'=>'sally@unity-pharmacy.com',
      'requested_on'=>Carbon::now()->subMinute(93),
    ]);

    DB::table('ticket')->insert([
      'ticket_code'=>'UP_'.$month_year.'_008',
      'stat'=>TicketStat::Declined,
      'accept_decline_reason'=>'Too expensive',
      'title'=>'Fix tap in pantry',
      'company_id'=>1,
      'office_id'=>2,
      'office_addr'=>'Address',
      'office_postal'=>'123456',
      'category_id'=>3,
      'urgency'=> TicketUrgency::High,
      'quoted_price'=>120,
      'requester_desc'=>'Inform Sally at reception when done',
      'operator_desc'=>'IMPT: Remember to clean up after completion',


      'requested_by'=>'Jane',
      'requester_mobile'=>'9123 4567',
      'requester_email'=>'jane@unity-pharmacy.com',
      'requested_on'=>Carbon::now()->subMinute(92),
    ]);

  }
}
