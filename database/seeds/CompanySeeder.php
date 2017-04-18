<?php

use App\Models\Enums\CompanyStat;
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
        'postal'=>'123456',
        'updated_by'=>'admin',
        'updated_on'=>date('Y-m-d H:i:s')
      ]);
    }
}
