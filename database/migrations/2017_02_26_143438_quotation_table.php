<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QuotationTable extends Migration
{
  public function up()
  {
    Schema::create('quotation', function(Blueprint $t) {
      $t->increments('quotation_id');
      $t->integer('ticket_id');
      $t->decimal('service_cost', 12, 2);
      $t->string('quotation_desc', 250);
      $t->string('quoted_by', 20);
      $t->dateTime('quoted_on');
      $t->string('updated_by', 20);
      $t->dateTime('updated_on');
    });
  }
  
  public function down()
  {
    Schema::dropIfExists('quotation');
  }
}
