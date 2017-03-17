<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TicketPreferredSlotTable extends Migration
{
    public function up()
    {
        Schema::create('ticket_preferred_slot', function(Blueprint $t) {
            $t->increments('ticket_preferred_slot_id');
            $t->integer('ticket_id');
            $t->date('date');
            $t->time('time_start');
            $t->time('time_end');
            $t->string('updated_by', 20);
            $t->dateTime('updated_on');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('ticket_preferred_slot');
    }
}
