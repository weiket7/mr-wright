<?php

use Illuminate\Database\Seeder;

class AccessSeeder extends Seeder
{
  public function run()
  {
    DB::table('access')->insert(['access_id'=>1, 'name'=>'ticket_draft']);
    DB::table('access')->insert(['access_id'=>2, 'name'=>'ticket_open']);
    DB::table('access')->insert(['access_id'=>3, 'name'=>'ticket_quote']);
    DB::table('access')->insert(['access_id'=>4, 'name'=>'ticket_accept']);
    DB::table('access')->insert(['access_id'=>5, 'name'=>'ticket_decline']);
    DB::table('access')->insert(['access_id'=>6, 'name'=>'ticket_complete']);
    DB::table('access')->insert(['access_id'=>7, 'name'=>'ticket_pay']);
    DB::table('access')->insert(['access_id'=>8, 'name'=>'ticket_void']);
    DB::table('access')->insert(['access_id'=>9, 'name'=>'company']);
    DB::table('access')->insert(['access_id'=>10, 'name'=>'office']);
    DB::table('access')->insert(['access_id'=>11, 'name'=>'requester']);
    DB::table('access')->insert(['access_id'=>12, 'name'=>'staff']);
    DB::table('access')->insert(['access_id'=>13, 'name'=>'operator']);
    DB::table('access')->insert(['access_id'=>14, 'name'=>'report']);
    DB::table('access')->insert(['access_id'=>15, 'name'=>'invoice']);
    DB::table('access')->insert(['access_id'=>16, 'name'=>'setting']);
  }
}
