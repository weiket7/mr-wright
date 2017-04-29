<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TicketHistoryTable extends Migration
{
  public function up()
  {
    Schema::create('ticket_history', function(Blueprint $t) {
      $t->increments('ticket_history_id');
      $t->integer('ticket_id');
      $t->string('action', 20);
      $t->string('action_by', 20);
      $t->dateTime('action_on');
    });
  }

  public function down()
  {
    Schema::dropIfExists('ticket_history');
  }
}
