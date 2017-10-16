<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SkillTable extends Migration
{
  public function up()
  {
    Schema::create('skill', function(Blueprint $t) {
      $t->increments('skill_id');
      $t->string('name', 50);
      $t->string('desc');
      $t->string('image', 50);
      $t->string('updated_by', 20);
      $t->dateTime('updated_on');
      $t->softDeletes();
    });
  }
  
  public function down()
  {
    Schema::dropIfExists('skill');
  }
}
