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
  }
}
