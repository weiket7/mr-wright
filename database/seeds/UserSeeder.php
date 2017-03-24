<?php

use App\Models\Enums\UserStat;
use App\Models\Enums\UserType;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
  public function run()
  {
    DB::table('user')->insert([
      'user_id'=>1,
      'username'=>'admin',
      'name'=>'Admin',
      'email'=>'admin@mrwright.sg',
      'password'=>Hash::make(123456),
      'type'=>UserType::Operator,
      'stat'=>UserStat::Active,
      'updated_by'=>'admin',
      'updated_on'=>Carbon::now(),
      'created_on'=>Carbon::now()
    ]);

    DB::table('user')->insert([
      'user_id'=>2,
      'username'=>'Misty',
      'name'=>'Misty',
      'email'=>'misty@mrwright.sg',
      'password'=>Hash::make(123456),
      'type'=>UserType::Operator,
      'stat'=>UserStat::Active,
      'updated_by'=>'admin',
      'updated_on'=>Carbon::now(),
      'created_on'=>Carbon::now()
    ]);

    DB::table('user')->insert([
      'user_id'=>3,
      'username'=>'Jessica',
      'name'=>'Jessica',
      'email'=>'jessica@mrwright.sg',
      'password'=>Hash::make(123456),
      'type'=>UserType::Operator,
      'stat'=>UserStat::Active,
      'updated_by'=>'admin',
      'updated_on'=>Carbon::now(),
      'created_on'=>Carbon::now()
    ]);

  }
}
