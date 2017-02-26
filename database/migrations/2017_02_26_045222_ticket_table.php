<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TicketTable extends Migration
{
  public function up()
  {
    Schema::create('ticket', function(Blueprint $t) {
      $t->increments('ticket_id');
      $t->string('name', 50);
      $t->integer('company_id');
      $t->integer('office_id');
      $t->integer('requester_id');

      $t->string('requested_by', 20);
      $t->dateTime('requested_on');
      $t->string('updated_by', 20);
      $t->dateTime('updated_on');
    });
  }
  
  public function down()
  {
    Schema::dropIfExists('ticket');
  }
}
