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
      $t->string('office_name', 50);
      $t->integer('category_id');
      $t->string('category_name', 30);
      $t->char('urgency', 1);
      $t->string('requested_by', 20);
      $t->dateTime('requested_on');
      $t->dateTime("completed_on");
      $t->string('office_addr', 100);
      $t->string('office_postal', 20);
      $t->string('requester_mobile', 100);
      $t->string('requester_email', 20);
      $t->decimal('quoted_price', 12, 2);
      $t->decimal('quoted_price_original', 12, 2);
      $t->date('quote_valid_till');
      $t->decimal('product_total', 12, 2);
      //$t->decimal('agreed_price', 12, 2); //TODO
      $t->char('payment_method', 1);
      $t->string('ref_no', 50);
      $t->string('requester_desc', 250);
      $t->string('operator_desc', 250);
      $t->string('quotation_desc', 500);
      $t->string('accept_decline_reason', 250);
      $t->softDeletes();
    });
  }
  
  public function down()
  {
    Schema::dropIfExists('ticket');
  }
}
