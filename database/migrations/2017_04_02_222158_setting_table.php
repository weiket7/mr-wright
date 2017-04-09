<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SettingTable extends Migration
{
  public function up()
  {
    Schema::create('setting', function(Blueprint $t) {
      $t->increments('setting_id');
      $t->string('name', 50);
      $t->string('value', 250);
    });
  }

  public function down()
  {
    Schema::dropIfExists('setting');
  }
}
