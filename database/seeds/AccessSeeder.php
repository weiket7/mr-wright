<?php

use App\Models\Enums\AccessType;
use Illuminate\Database\Seeder;

class AccessSeeder extends Seeder
{
  public function run()
  {
    DB::table('access')->insert(['access_id'=>1, 'name'=>'ticket', 'type'=>AccessType::Module]);
    DB::table('access')->insert(['access_id'=>2, 'name'=>'ticket_draft', 'type'=>AccessType::Feature]);
    DB::table('access')->insert(['access_id'=>3, 'name'=>'ticket_open', 'type'=>AccessType::Feature]);
    DB::table('access')->insert(['access_id'=>4, 'name'=>'ticket_quote', 'type'=>AccessType::Feature]);
    DB::table('access')->insert(['access_id'=>5, 'name'=>'ticket_respond', 'type'=>AccessType::Feature]);
    DB::table('access')->insert(['access_id'=>6, 'name'=>'ticket_complete', 'type'=>AccessType::Feature]);
    DB::table('access')->insert(['access_id'=>7, 'name'=>'ticket_invoice', 'type'=>AccessType::Feature]);
    DB::table('access')->insert(['access_id'=>8, 'name'=>'ticket_pay', 'type'=>AccessType::Feature]);
    DB::table('access')->insert(['access_id'=>9, 'name'=>'ticket_void', 'type'=>AccessType::Feature]);
    DB::table('access')->insert(['access_id'=>10, 'name'=>'company', 'type'=>AccessType::Module]);
    DB::table('access')->insert(['access_id'=>11, 'name'=>'office', 'type'=>AccessType::Module]);
    DB::table('access')->insert(['access_id'=>12, 'name'=>'requester', 'type'=>AccessType::Module]);
    DB::table('access')->insert(['access_id'=>13, 'name'=>'staff', 'type'=>AccessType::Module]);
    DB::table('access')->insert(['access_id'=>14, 'name'=>'operator', 'type'=>AccessType::Module]);
    DB::table('access')->insert(['access_id'=>15, 'name'=>'report', 'type'=>AccessType::Module]);
    DB::table('access')->insert(['access_id'=>16, 'name'=>'invoice', 'type'=>AccessType::Module]);
    DB::table('access')->insert(['access_id'=>17, 'name'=>'setting', 'type'=>AccessType::Module]);
    DB::table('access')->insert(['access_id'=>18, 'name'=>'system', 'type'=>AccessType::Module]);
    DB::table('access')->insert(['access_id'=>19, 'name'=>'skill', 'type'=>AccessType::Module]);
    DB::table('access')->insert(['access_id'=>20, 'name'=>'role', 'type'=>AccessType::Module]);
    DB::table('access')->insert(['access_id'=>21, 'name'=>'access', 'type'=>AccessType::Module]);
    DB::table('access')->insert(['access_id'=>22, 'name'=>'category-for-ticket', 'type'=>AccessType::Module]);
    DB::table('access')->insert(['access_id'=>23, 'name'=>'frontend', 'type'=>AccessType::Module]);
    DB::table('access')->insert(['access_id'=>24, 'name'=>'registration', 'type'=>AccessType::Module]);
  }
}
