<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RoleAccessTable extends Migration
{
  public function up()
  {
    Schema::create('role_access', function(Blueprint $t) {
      $t->increments('role_access_id');
      $t->integer('role_id');
      $t->integer('access_id');
      $t->string('updated_by', 20);
      $t->dateTime('updated_on');
    });
  }

  public function down()
  {
    Schema::dropIfExists('role_access');
  }
}
