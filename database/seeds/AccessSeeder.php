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
    DB::table('access')->insert(['access_id'=>10, 'name'=>'ticket_view_quoted_price', 'type'=>AccessType::Feature]);
    DB::table('access')->insert(['access_id'=>11, 'name'=>'ticket_view_otp', 'type'=>AccessType::Feature]);
    DB::table('access')->insert(['access_id'=>12, 'name'=>'ticket_view_enter_otp', 'type'=>AccessType::Feature]);
    DB::table('access')->insert(['access_id'=>51, 'name'=>'company', 'type'=>AccessType::Module]);
    DB::table('access')->insert(['access_id'=>52, 'name'=>'office', 'type'=>AccessType::Module]);
    DB::table('access')->insert(['access_id'=>53, 'name'=>'requester', 'type'=>AccessType::Module]);
    DB::table('access')->insert(['access_id'=>54, 'name'=>'staff', 'type'=>AccessType::Module]);
    DB::table('access')->insert(['access_id'=>55, 'name'=>'operator', 'type'=>AccessType::Module]);
    DB::table('access')->insert(['access_id'=>56, 'name'=>'report', 'type'=>AccessType::Module]);
    DB::table('access')->insert(['access_id'=>57, 'name'=>'invoice', 'type'=>AccessType::Module]);
    DB::table('access')->insert(['access_id'=>58, 'name'=>'setting', 'type'=>AccessType::Module]);
    DB::table('access')->insert(['access_id'=>59, 'name'=>'system', 'type'=>AccessType::Module]);
    DB::table('access')->insert(['access_id'=>60, 'name'=>'skill', 'type'=>AccessType::Module]);
    DB::table('access')->insert(['access_id'=>61, 'name'=>'role', 'type'=>AccessType::Module]);
    DB::table('access')->insert(['access_id'=>62, 'name'=>'access', 'type'=>AccessType::Module]);
    DB::table('access')->insert(['access_id'=>63, 'name'=>'category-for-ticket', 'type'=>AccessType::Module]);
    DB::table('access')->insert(['access_id'=>64, 'name'=>'frontend', 'type'=>AccessType::Module]);
    DB::table('access')->insert(['access_id'=>65, 'name'=>'registration', 'type'=>AccessType::Module]);
    DB::table('access')->insert(['access_id'=>66, 'name'=>'payment-method', 'type'=>AccessType::Module]);
    DB::table('access')->insert(['access_id'=>67, 'name'=>'membership', 'type'=>AccessType::Module]);
  }
}
