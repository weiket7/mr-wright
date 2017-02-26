<?php

use App\Models\Enums\UserType;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
  public function run()
  {
    DB::table('user')->insert([
      'user_id'=>1,
      'username'=>'admin',
      'name'=>'Admin',
      'type'=>UserType::Requester,
      'updated_by'=>'admin',
      'updated_on'=>date('Y-m-d H:i:s')
    ]);
  }
}
