<?php

use App\Models\Enums\UserStat;
use App\Models\Enums\Role;
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
      'role_id'=>1, //admin
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
      'role_id'=>3, //operator
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
      'role_id'=>3, //operator
      'stat'=>UserStat::Active,
      'updated_by'=>'admin',
      'updated_on'=>Carbon::now(),
      'created_on'=>Carbon::now()
    ]);

    DB::table('user')->insert([
      'user_id'=>4,
      'username'=>'Sally',
      'name'=>'Sally',
      'email'=>'sally@unity-pharmacy.sg',
      'password'=>Hash::make(123456),
      'role_id'=>5, //requester
      'stat'=>UserStat::Active,
      'updated_by'=>'admin',
      'updated_on'=>Carbon::now(),
      'created_on'=>Carbon::now()
    ]);

    DB::table('user')->insert([
      'user_id'=>5,
      'username'=>'Jane',
      'name'=>'Jane',
      'email'=>'jane@unity-pharmacy.sg',
      'password'=>Hash::make(123456),
      'role_id'=>5, //requester
      'stat'=>UserStat::Active,
      'updated_by'=>'admin',
      'updated_on'=>Carbon::now(),
      'created_on'=>Carbon::now()
    ]);

    DB::table('user')->insert([
      'user_id'=>6,
      'username'=>'Candice',
      'name'=>'Candice',
      'email'=>'candice@mrwright.sg',
      'password'=>Hash::make(123456),
      'role_id'=>2, //finance
      'stat'=>UserStat::Active,
      'updated_by'=>'admin',
      'updated_on'=>Carbon::now(),
      'created_on'=>Carbon::now()
    ]);

  }
}
