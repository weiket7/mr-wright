<?php

use App\Models\Enums\MembershipStat;
use Illuminate\Database\Seeder;

class MembershipSeeder extends Seeder
{
    public function run()
    {
      DB::table('membership')->insert([
        'membership_id'=>1,
        'stat'=>MembershipStat::Active,
        'name'=>'Tier 1 - 1 requesters at $30/month',
        'requester_limit'=>1,
        'effective_price'=>30,
      ]);
  
      DB::table('membership')->insert([
        'membership_id'=>2,
        'stat'=>MembershipStat::Active,
        'name'=>'Tier 2 - 3 requesters at $40/month',
        'requester_limit'=>3,
        'effective_price'=>40,
      ]);
  
      DB::table('membership')->insert([
        'membership_id'=>3,
        'stat'=>MembershipStat::Active,
        'name'=>'Tier 3 - 5 requesters at $50/month',
        'requester_limit'=>5,
        'effective_price'=>50,
      ]);
  
      DB::table('membership')->insert([
        'membership_id'=>4,
        'stat'=>MembershipStat::Active,
        'name'=>'Tier 4 - 10 requesters at $60/month',
        'requester_limit'=>10,
        'effective_price'=>60,
      ]);
    }
}
