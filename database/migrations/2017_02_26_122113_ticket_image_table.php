<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TicketImageTable extends Migration
{
  public function up()
  {
    Schema::create('ticket_image', function(Blueprint $t) {
      $t->increments('ticket_image_id');
      $t->integer('ticket_id');
      $t->string('image', 50);
      $t->string('updated_by', 20);
      $t->dateTime('updated_on');
    });
  }

  public function down()
  {
    Schema::dropIfExists('ticket_image');
  }
}
