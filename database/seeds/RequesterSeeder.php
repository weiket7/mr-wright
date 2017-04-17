<?php

use App\Models\Enums\PreferredContact;
use App\Models\Enums\RequesterStat;
use App\Models\Enums\RequesterType;
use Illuminate\Database\Seeder;

class RequesterSeeder extends Seeder
{
  public function run()
  {
    DB::table('requester')->insert([
      'stat'=>RequesterStat::Active,
      'company_id'=>1,
      'office_id'=>1,
      'name'=>'Sally',
      'username'=>'Sally',
      'is_admin'=>true,
      'type'=> RequesterType::Corporate,
      'designation'=>'Secretary',
      'mobile'=>'91234567',
      'email'=>'sally@unity-pharmacy.com',
      'work'=>'6123456',
      'preferred_contact'=>PreferredContact::Mobile,
      'updated_by'=>'admin',
      'updated_on'=>date('Y-m-d H:i:s')
    ]);

    DB::table('requester')->insert([
      'stat'=>RequesterStat::Active,
      'company_id'=>1,
      'office_id'=>2,
      'name'=>'Jane',
      'username'=>'Jane',
      'is_admin'=>false,
      'type'=> RequesterType::Corporate,
      'designation'=>'Secretary',
      'mobile'=>'91234567',
      'email'=>'jane@unity-pharmacy.com',
      'work'=>'6123456',
      'preferred_contact'=>PreferredContact::Mobile,
      'updated_by'=>'admin',
      'updated_on'=>date('Y-m-d H:i:s')
    ]);

    DB::table('requester')->insert([
      'stat'=>RequesterStat::Active,
      'company_id'=>1,
      'office_id'=>2,
      'name'=>'Olivia',
      'username'=>'olivia',
      'is_admin'=>true,
      'type'=> RequesterType::Individual,
      'designation'=>'Secretary',
      'mobile'=>'91234567',
      'work'=>'6123456',
      'email'=>'olivia@hotmail.com',
      'preferred_contact'=>PreferredContact::Mobile,
      'updated_by'=>'admin',
      'updated_on'=>date('Y-m-d H:i:s')
    ]);
  }
}
