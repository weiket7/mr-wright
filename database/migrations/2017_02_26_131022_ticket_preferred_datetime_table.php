<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TicketPreferredDatetimeTable extends Migration
{
    public function up()
    {
        Schema::create('ticket_preferred_datetime', function(Blueprint $t) {
            $t->increments('ticket_preferred_datetime_id');
            $t->integer('ticket_id');
            $t->date('date_from');
            $t->date('date_to');
            $t->time('time_from');
            $t->time('time_to');
            $t->string('updated_by', 20);
            $t->dateTime('updated_on');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('ticket_preferred_datetime');
    }
}
