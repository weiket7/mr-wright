<?php

use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run()
    {
      DB::table('company')->insert([
        'company_id'=>1,
        'name'=>'Unity Pharmacy',
        'updated_by'=>'admin',
        'updated_on'=>date('Y-m-d H:i:s')
      ]);

      DB::table('company')->insert([
        'company_id'=>2,
        'name'=>'Zendesk',
        'updated_by'=>'admin',
        'updated_on'=>date('Y-m-d H:i:s')
      ]);
    }
}
