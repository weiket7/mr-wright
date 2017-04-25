<?php

use App\Models\Enums\OfficeStat;
use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
{
  public function run()
  {
    DB::table('office')->insert([
      'office_id'=>1,
      'stat'=>OfficeStat::Active,
      'name'=>'Tampines Outlet',
      'company_id'=>1,
      'addr'=>'Tampines Address',
      'postal'=>'123456',
      'requester_count'=>1,
      'updated_by'=>'admin',
      'updated_on'=>date('Y-m-d H:i:s')
    ]);
    DB::table('office')->insert([
      'office_id'=>2,
      'stat'=>OfficeStat::Active,
      'name'=>'Bedok Outlet',
      'company_id'=>1,
      'addr'=>'Bedok Address',
      'postal'=>'123456',
      'requester_count'=>1,
      'updated_by'=>'admin',
      'updated_on'=>date('Y-m-d H:i:s')
    ]);
    DB::table('office')->insert([
      'office_id'=>3,
      'stat'=>OfficeStat::Active,
      'name'=>'Jurong Outlet',
      'company_id'=>2,
      'addr'=>'Jurong Address',
      'postal'=>'123456',
      'updated_by'=>'admin',
      'updated_on'=>date('Y-m-d H:i:s')
    ]);
    DB::table('office')->insert([
      'office_id'=>4,
      'stat'=>OfficeStat::Active,
      'name'=>'Ang Mo Kio Outlet',
      'company_id'=>2,
      'addr'=>'AMK Address',
      'postal'=>'123456',
      'updated_by'=>'admin',
      'updated_on'=>date('Y-m-d H:i:s')
    ]);
  }
}
