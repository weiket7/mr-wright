<?php

use App\Models\Enums\CompanyStat;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run()
    {
      DB::table('company')->insert([
        'stat'=>CompanyStat::Active,
        'name'=>'Unity Pharmacy',
        'registered_name'=>'Unity Pharmacy Pte Ltd',
        'updated_by'=>'admin',
        'updated_on'=>date('Y-m-d H:i:s')
      ]);

      DB::table('company')->insert([
        'stat'=>CompanyStat::Active,
        'name'=>'Zendesk',
        'registered_name'=>'Zendesk Pte Ltd',
        'updated_by'=>'admin',
        'updated_on'=>date('Y-m-d H:i:s')
      ]);
    }
}
