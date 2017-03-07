<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TicketSkillTable extends Migration
{
  public function up()
  {
    Schema::create('ticket_skill', function (Blueprint $t) {
      $t->increments('ticket_skill_id');
      $t->integer('ticket_id');
      $t->integer('skill_id');
      $t->string('updated_by', 20);
      $t->dateTime('updated_on');
    });
  }

  public function down()
  {
    Schema::dropIfExists('ticket_skill');

  }
}
