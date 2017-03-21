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
      $t->string('ticket_code', 15);
      $t->char('stat', 1);
      $t->string('title', 100);
      $t->integer('company_id');
      $t->string('company_name', 50);
      $t->integer('office_id');
      $t->integer('category_id');
      $t->string('category_name', 30);
      $t->char('urgency', 1);
      $t->decimal('quoted_price', 12, 2);
      $t->decimal('agreed_price', 12, 2);
      $t->string('requester_desc', 250);
      $t->string('operator_desc', 250);
      $t->string('quotation_desc', 250);

      $t->string('drafted_by', 20);
      $t->dateTime('drafted_on');
      $t->string('opened_by', 20);
      $t->dateTime('opened_on');
      $t->string('quoted_by', 20);
      $t->dateTime('quoted_on');
      $t->string('accepted_by', 20);
      $t->dateTime('accepted_on');
      $t->string('completed_by', 20);
      $t->dateTime('completed_on');
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
