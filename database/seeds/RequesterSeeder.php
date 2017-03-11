<?php

use App\Models\Enums\PreferredContact;
use App\Models\Enums\RequesterStat;
use Illuminate\Database\Seeder;

class RequesterSeeder extends Seeder
{
  public function run()
  {
    DB::table('requester')->insert([
      'stat'=>RequesterStat::Active,
      'company_id'=>1,
      'office_id'=>1,
      'name'=>'Admin',
      'designation'=>'Secretary',
      'mobile'=>'91234567',
      'email'=>'admin@unity-pharmacy.com',
      'work'=>'6123456',
      'preferred_contact'=>PreferredContact::Mobile,
      'updated_by'=>'admin',
      'updated_on'=>date('Y-m-d H:i:s')
    ]);
  }
}
