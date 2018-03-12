<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TicketOtpTable extends Migration
{
  public function up()
  {
    Schema::create('ticket_otp', function(Blueprint $t) {
      $t->increments('ticket_otp_id');
      $t->integer('ticket_id');
      $t->string('first_otp', 6);
      $t->string('second_otp', 6);
      $t->string('first_entered_by', 30);
      $t->string('second_entered_by', 30);
      $t->dateTime('first_entered_on')->nullable();
      $t->dateTime('second_entered_on')->nullable();
    });
  }
  
  public function down()
  {
    Schema::dropIfExists('ticket_otp');
  }
}
