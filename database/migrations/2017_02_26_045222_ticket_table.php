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
      $t->integer('office_name');
      $t->integer('office_id');
      $t->integer('category_id');
      $t->char('urgency', 1);
      $t->string('requested_by', 20);
      $t->date('requested_on');
      $t->string('addr', 100);
      $t->string('postal', 20);
      $t->decimal('quoted_price', 12, 2);
      $t->date('quote_valid_till');
      $t->decimal('product_total', 12, 2);
      //$t->decimal('agreed_price', 12, 2); //TODO
      $t->char('payment_method', 1);
      $t->string('ref_no', 50);
      $t->string('requester_desc', 250);
      $t->string('operator_desc', 250);
      $t->string('quotation_desc', 250);
      $t->string('accept_decline_reason', 250);

      $t->string('drafted_by', 20);
      $t->dateTime('drafted_on');
      $t->string('opened_by', 20);
      $t->dateTime('opened_on');
      $t->string('quoted_by', 20);
      $t->dateTime('quoted_on');
      $t->string('accepted_by', 20);
      $t->dateTime('accepted_on');
      $t->string('declined_by', 20);
      $t->dateTime('declined_on');
      $t->string('completed_by', 20);
      $t->dateTime('completed_on');
      $t->string('invoiced_by', 20);
      $t->dateTime('invoiced_on');
      $t->string('paid_by', 20);
      $t->dateTime('paid_on');
      $t->string('updated_by', 20);
      $t->dateTime('updated_on');
      $t->string('recent_action', 15);
    });
  }
  
  public function down()
  {
    Schema::dropIfExists('ticket');
  }
}
