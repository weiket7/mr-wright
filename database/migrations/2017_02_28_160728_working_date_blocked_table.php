<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WorkingDateBlockedTable extends Migration
{
    public function up()
    {
        Schema::create('working_date_blocked', function(Blueprint $t) {
            $t->increments('working_date_blocked_id');
            $t->date('date');
            $t->string('updated_by', 20);
            $t->dateTime('updated_on');
        });
    }

    public function down()
    {
        Schema::dropIfExists('working_date_blocked');
    }
}
