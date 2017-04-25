<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InviteTable extends Migration
{
  public function up()
  {
    Schema::create('invite', function(Blueprint $t) {
      $t->increments('invite_id');
      $t->boolean('accepted');
      $t->string('invited_by', 30);
      $t->string('username', 30);
      $t->string('name', 50);
      $t->string('designation', 30);
      $t->string('email', 100);
      $t->string('mobile', 30);
      $t->integer('company_id');
      $t->integer('office_id');
      $t->string('token', 20);
      $t->timestamps();
    });
  }
  
  public function down()
  {
    Schema::dropIfExists('invite');
  }
}
