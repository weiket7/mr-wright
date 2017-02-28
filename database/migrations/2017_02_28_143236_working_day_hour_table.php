<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WorkingDayHourTable extends Migration
{
    public function up()
    {
        Schema::create('working_day_hour', function(Blueprint $t) {
            $t->increments('working_day_hour_id');
            $t->smallInteger('day');
            $t->time('time_from');
            $t->time('time_to');
            $t->string('updated_by', 20);
            $t->dateTime('updated_on');
        });
    }

    public function down()
    {
        Schema::dropIfExists('working_day_hour');
    }
}
