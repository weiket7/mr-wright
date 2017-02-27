<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CategoryForTicketTable extends Migration
{
    public function up()
    {
        Schema::create('category_for_ticket', function(Blueprint $t) {
            $t->increments('category_for_ticket_id');
            $t->string('name', 30);
            $t->string('updated_by', 20);
            $t->dateTime('updated_on');
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_for_ticket');
    }
}
