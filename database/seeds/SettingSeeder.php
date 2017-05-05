<?php

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{

  public function run()
  {
    DB::table('setting')->insert([
      'name'=>'quote_valid_working_days',
      'value'=>7,
    ]);
    DB::table('setting')->insert([
      'name'=>'otp_first_valid_minutes',
      'value'=>30,
    ]);
    DB::table('setting')->insert([
      'name'=>'paydollar_merchant_id',
      'value'=>12104485,
    ]);
    DB::table('setting')->insert([
    'name'=>'paydollar_post_url',
    'value'=>'https://test.paydollar.com/b2cDemo/eng/payment/payForm.jsp',
  ]);
  }
}
