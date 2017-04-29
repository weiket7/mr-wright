<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ForgotPasswordTable extends Migration
{
  public function up()
  {
    Schema::create('forgot_password', function(Blueprint $t) {
      $t->increments('forgot_password_id');
      $t->char('stat', 1);
      $t->string('email', 100);
      $t->string('token', 30);
      $t->dateTime('created_on');
      $t->dateTime('updated_on');
    });
  }
  
  public function down()
  {
    Schema::dropIfExists('forgot_password');
  }
}
