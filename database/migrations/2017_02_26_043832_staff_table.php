<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StaffTable extends Migration
{
  public function up()
  {
    Schema::create('staff', function(Blueprint $t) {
      $t->increments('staff_id');
      $t->string('name', 50);
      $t->char('stat', 1);
      $t->string('updated_by', 20);
      $t->dateTime('updated_on');
    });
  }
  
  public function down()
  {
    Schema::dropIfExists('staff');
  }
}
