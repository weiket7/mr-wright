<?php

use App\Models\Enums\MembershipStat;
use App\Models\Enums\MembershipType;
use Illuminate\Database\Seeder;

class MembershipSeeder extends Seeder
{
  public function run()
  {
    /*DB::table('membership')->insert([
      'membership_id'=>1,
      'stat'=>MembershipStat::Active,
      'name'=>'Free Trial',
      'requester_limit'=>1,
      'effective_price'=>0,
      'full_name'=>'Free Trial',
      'position'=>1,
      'free_trial'=>1,
    ]);*/

    DB::table('membership')->insert([
      'membership_id'=>1,
      'stat'=>MembershipStat::Active,
      'type'=>MembershipType::Yearly,
      'name'=>'Light',
      'requester_limit'=>3,
      'effective_price'=>2.2,
      'full_name'=>'Light - 3 users at $40.00 / month',
      'position'=>1,
    ]);

    DB::table('membership')->insert([
      'membership_id'=>2,
      'stat'=>MembershipStat::Active,
      'type'=>MembershipType::Yearly,
      'name'=>'Medium',
      'requester_limit'=>5,
      'effective_price'=>3.3,
      'full_name'=>'Medium - 5 users at $50.00 / month',
      'position'=>2,
    ]);
    
    DB::table('membership')->insert([
      'membership_id'=>3,
      'stat'=>MembershipStat::Active,
      'type'=>MembershipType::Yearly,
      'name'=>'Heavy',
      'requester_limit'=>10,
      'effective_price'=>5.5,
      'full_name'=>'Heavy - 5 users at $50.00 / month',
      'position'=>3,
    ]);
    
    DB::table('membership_detail')->insert([
      'membership_id'=>1,
      'position'=>1,
      'content'=>'$200 (sign up fee)',
    ]);
    DB::table('membership_detail')->insert([
      'membership_id'=>1,
      'position'=>2,
      'content'=>'Unlimited tickets',
    ]);
    DB::table('membership_detail')->insert([
      'membership_id'=>1,
      'position'=>3,
      'content'=>'$200 credits for repairs',
    ]);
  
    DB::table('membership_detail')->insert([
      'membership_id'=>2,
      'position'=>1,
      'content'=>'$500 (sign up fee)',
    ]);
    DB::table('membership_detail')->insert([
      'membership_id'=>2,
      'position'=>2,
      'content'=>'Unlimited tickets',
    ]);
    DB::table('membership_detail')->insert([
      'membership_id'=>2,
      'position'=>3,
      'content'=>'$500 credits for repairs',
    ]);
    DB::table('membership_detail')->insert([
      'membership_id'=>2,
      'position'=>4,
      'content'=>'Free 2x Yearly Electrical and Plumbing Check-ups',
    ]);
    DB::table('membership_detail')->insert([
      'membership_id'=>2,
      'position'=>5,
      'content'=>'Maintenance Reporting',
    ]);
  
    DB::table('membership_detail')->insert([
      'membership_id'=>3,
      'position'=>1,
      'content'=>'$1,000 (sign up fee)',
    ]);
    DB::table('membership_detail')->insert([
      'membership_id'=>3,
      'position'=>2,
      'content'=>'Unlimited tickets',
    ]);
    DB::table('membership_detail')->insert([
      'membership_id'=>3,
      'position'=>3,
      'content'=>'$1,000 credits for repairs',
    ]);
    DB::table('membership_detail')->insert([
      'membership_id'=>3,
      'position'=>4,
      'content'=>'Free 4x Yearly Electrical and Plumbing Check-ups ',
    ]);
    DB::table('membership_detail')->insert([
      'membership_id'=>3,
      'position'=>5,
      'content'=>'Maintenance Reporting',
    ]);
    DB::table('membership_detail')->insert([
      'membership_id'=>3,
      'position'=>6,
      'content'=>'Free Labour for Lightbulb change',
    ]);
    DB::table('membership_detail')->insert([
      'membership_id'=>3,
      'position'=>7,
      'content'=>'Electrical Power Supply Yearly License $250 (market price - $500) ',
    ]);
    DB::table('membership_detail')->insert([
      'membership_id'=>3,
      'position'=>8,
      'content'=>'Free 3D MAX Drawing (Biannually) + Additional discounts',
    ]);
  }
}
