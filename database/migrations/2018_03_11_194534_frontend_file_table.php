<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FrontendFileTable extends Migration
{
  public function up()
  {
    Schema::create('frontend_file', function (Blueprint $t) {
      $t->increments('frontend_file_id');
      $t->string('key', 50);
      $t->string('file_name', 50);
    });
    
    DB::table('frontend_file')->insert([
      'key'=>'membership_details',
      'file_name'=>'mr-wright-membership-details.pdf',
    ]);
    
  }
  
  public function down()
  {
    Schema::dropIfExists('frontend_file');
  }
}
