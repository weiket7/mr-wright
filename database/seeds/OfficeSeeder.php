<?php

use App\Models\Enums\OfficeStat;
use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
{
  public function run()
  {
    DB::table('office')->insert([
      'stat'=>OfficeStat::Active,
      'name'=>'Tampines Outlet',
      'company_id'=>1,
      'addr'=>'Address',
      'postal'=>'123456',
      'updated_by'=>'admin',
      'updated_on'=>date('Y-m-d H:i:s')
    ]);
    DB::table('office')->insert([
      'stat'=>OfficeStat::Active,
      'name'=>'Bedok Outlet',
      'company_id'=>1,
      'addr'=>'Address',
      'postal'=>'123456',
      'updated_by'=>'admin',
      'updated_on'=>date('Y-m-d H:i:s')
    ]);
    DB::table('office')->insert([
      'stat'=>OfficeStat::Active,
      'name'=>'Jurong Outlet',
      'company_id'=>2,
      'addr'=>'Address',
      'postal'=>'123456',
      'updated_by'=>'admin',
      'updated_on'=>date('Y-m-d H:i:s')
    ]);
    DB::table('office')->insert([
      'stat'=>OfficeStat::Active,
      'name'=>'Ang Mo Kio Outlet',
      'company_id'=>2,
      'addr'=>'Address',
      'postal'=>'123456',
      'updated_by'=>'admin',
      'updated_on'=>date('Y-m-d H:i:s')
    ]);
  }
}
