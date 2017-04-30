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
      'name'=>'Tier 1',
      'requester_limit'=>1,
      'effective_price'=>30,
      'full_name'=>'Tier 1 - 1 user at $30.00 / month',
      'position'=>1,
    ]);

    DB::table('membership')->insert([
      'membership_id'=>2,
      'stat'=>MembershipStat::Active,
      'name'=>'Tier 2',
      'requester_limit'=>3,
      'effective_price'=>40,
      'full_name'=>'Tier 2 - 3 users at $40.00 / month',
      'position'=>2,
    ]);

    DB::table('membership')->insert([
      'membership_id'=>3,
      'stat'=>MembershipStat::Active,
      'name'=>'Tier 3',
      'requester_limit'=>5,
      'effective_price'=>50,
      'full_name'=>'Tier 3 - 5 users at $50.00 / month',
      'position'=>3,
    ]);

    DB::table('membership')->insert([
      'membership_id'=>4,
      'stat'=>MembershipStat::Active,
      'name'=>'Tier 4',
      'requester_limit'=>10,
      'effective_price'=>60,
      'full_name'=>'Tier 4 - 10 users at $60.00 / month',
      'position'=>4,
    ]);
  }
}
