<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TicketNoShowTable extends Migration
{
    public function up()
    {
      Schema::create('ticket_no_show', function(Blueprint $t) {
        $t->increments('id');
        $t->integer('ticket_id');
        $t->dateTime('created_on');
      });
    }

    public function down()
    {
      Schema::dropIfExists('ticket_no_show');
    }
}
