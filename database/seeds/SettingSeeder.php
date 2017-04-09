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
    'name'=>'invoice_payment_to',
    'value'=>'Please make payment to Mr Wright via:
      1.
      2.'
  ]);
  }
}
