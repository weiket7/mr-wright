<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TemplateTable extends Migration
{
  public function up()
  {
    Schema::create('template', function(Blueprint $t) {
      $t->increments('template_id');
      $t->string('name', 50);
      $t->string('updated_by', 20);
      $t->dateTime('updated_on');
    });
  }

  public function down()
  {
    Schema::dropIfExists('template');
  }
}
