<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AccessTable extends Migration
{
  public function up()
  {
    Schema::create('access', function(Blueprint $t) {
      $t->increments('access_id');
      //$t->char('user_type', 1);
      $t->string('name', 50);
      $t->char('type', 1);
      $t->string('updated_by', 20);
      $t->dateTime('updated_on');
    });
  }

  public function down()
  {
    Schema::dropIfExists('access');
  }
}
