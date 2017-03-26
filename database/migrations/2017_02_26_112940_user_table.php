<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserTable extends Migration
{
  public function up()
  {
    Schema::create('user', function(Blueprint $t) {
      $t->increments('user_id');
      $t->string('username', 20);
      $t->string('password', 60);
      $t->string('email', 100);
      $t->string('name', 50);
      $t->char('role', 1);
      $t->char('stat', 1);
      $t->string('remember_token', 100);
      $t->string('updated_by', 20);
      $t->dateTime('updated_on');
      $t->dateTime('created_on');
    });
  }

  public function down()
  {
    Schema::dropIfExists('user');
  }
}
