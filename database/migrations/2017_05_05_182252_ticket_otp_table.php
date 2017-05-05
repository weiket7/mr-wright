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
            $t->string('otp', 10);
            $t->date('date');
            $t->tinyInteger('type');
            $t->boolean('entered');
            $t->dateTime('created_on');
            $t->dateTime('entered_on');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ticket_otp');
    }
}
