<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WorkingHourBlockedTable extends Migration
{
    public function up()
    {
        Schema::create('working_hour_blocked', function(Blueprint $t) {
            $t->increments('working_hour_blocked_id');
            $t->date('date');
            $t->time('time_from');
            $t->time('time_to');
            $t->string('updated_by', 20);
            $t->dateTime('updated_on');
        });
    }

    public function down()
    {
        Schema::dropIfExists('working_hour_blocked');
    }
}
