<?php

use App\Models\Enums\PreferredContact;
use App\Models\Enums\RequesterStat;
use App\Models\Enums\RequesterType;
use Carbon\Carbon;
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
      'admin'=>true,
      'type'=> RequesterType::Corporate,
      'designation'=>'Secretary',
      'mobile'=>'91234567',
      'email'=>'sally@unity-pharmacy.com',
      'work'=>'6123456',
      'preferred_contact'=>PreferredContact::Mobile,
      'updated_by'=>'admin',
      'updated_on'=>Carbon::now(),
      'created_on'=>Carbon::now()
    ]);

    DB::table('requester')->insert([
      'stat'=>RequesterStat::Active,
      'company_id'=>1,
      'office_id'=>2,
      'name'=>'Jane',
      'username'=>'Jane',
      'admin'=>false,
      'type'=> RequesterType::Corporate,
      'designation'=>'Secretary',
      'mobile'=>'91234567',
      'email'=>'jane@unity-pharmacy.com',
      'work'=>'6123456',
      'preferred_contact'=>PreferredContact::Mobile,
      'updated_by'=>'admin',
      'updated_on'=>Carbon::now(),
      'created_on'=>Carbon::now()
    ]);

    DB::table('requester')->insert([
      'stat'=>RequesterStat::Active,
      'company_id'=>2,
      'office_id'=>3,
      'name'=>'Olivia',
      'username'=>'olivia',
      'admin'=>true,
      'type'=> RequesterType::Corporate,
      'designation'=>'Secretary',
      'mobile'=>'91234567',
      'work'=>'6123456',
      'email'=>'olivia@hotmail.com',
      'preferred_contact'=>PreferredContact::Mobile,
      'updated_by'=>'admin',
      'updated_on'=>Carbon::now(),
      'created_on'=>Carbon::now()
    ]);
  }
}
