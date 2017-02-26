<?php

use App\Models\Enums\PreferredContact;
use Illuminate\Database\Seeder;

class RequesterSeeder extends Seeder
{
  public function run()
  {
    DB::table('requester')->insert([
      'requester_id'=>1,
      'company_id'=>1,
      'username'=>'admin',
      'name'=>'Admin',
      'mobile'=>'91234567',
      'email'=>'admin@unity-pharmacy.com',
      'office'=>'6123456',
      'preferred_contact'=>PreferredContact::Mobile,
      'updated_by'=>'admin',
      'updated_on'=>date('Y-m-d H:i:s')
    ]);
  }
}
