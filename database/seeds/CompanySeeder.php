<?php

use App\Models\Enums\CompanyStat;
use App\Models\Enums\MembershipType;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run()
    {
      DB::table('company')->insert([
        'code'=>'UP',
        'stat'=>CompanyStat::Active,
        'name'=>'Unity Pharmacy',
        'uen'=>'1234-5678',
        'registered_name'=>'Unity Pharmacy Pte Ltd',
        'addr'=>'unity address',
        'membership_id'=>2,
        'membership_name'=>'Tier 2 - 3 requesters at $40/month',
        'membership_type'=>MembershipType::Yearly,
        'membership_valid_till'=>Carbon::now()->addYear(1),
        'effective_price'=>40,
        'requester_limit'=>3,
        'requester_count'=>2,
        'postal'=>'123456',
        'updated_by'=>'admin',
        'updated_on'=>date('Y-m-d H:i:s')
      ]);

      DB::table('company')->insert([
        'code'=>'ZD',
        'stat'=>CompanyStat::Active,
        'name'=>'Zendesk',
        'uen'=>'3456-7890',
        'registered_name'=>'Zendesk Pte Ltd',
        'addr'=>'zendesk address',
        'membership_id'=>1,
        'membership_name'=>'Free Trial',
        'membership_type'=>MembershipType::Monthly,
        'membership_valid_till'=>Carbon::now()->addMonth(1),
        'effective_price'=>0,
        'requester_limit'=>1,
        'requester_count'=>1,
        'free_trial'=>1,
        'postal'=>'123456',
        'updated_by'=>'admin',
        'updated_on'=>date('Y-m-d H:i:s')
      ]);
    }
}
