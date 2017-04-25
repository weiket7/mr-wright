<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OfficeTable extends Migration
{
  public function up()
  {
    Schema::create('office', function(Blueprint $t) {
      $t->increments('office_id');
      $t->integer('company_id');
      $t->char('stat', 1);
      $t->string('name', 50);
      $t->string('addr', 200);
      $t->string('postal', 20);
      $t->integer('requester_count');
      /*$t->string('country', 50);
      $t->string('state', 50);
      $t->string('city', 50);*/
      $t->string('updated_by', 20);
      $t->dateTime('updated_on');
    });
  }

  public function down()
  {
    Schema::dropIfExists('office');
  }
}
