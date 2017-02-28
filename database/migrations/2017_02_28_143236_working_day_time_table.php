<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WorkingDayTimeTable extends Migration
{
    public function up()
    {
        Schema::create('working_day_time', function(Blueprint $t) {
            $t->increments('working_day_time_id');
            $t->smallInteger('day');
            $t->time('time_start');
            $t->time('time_end');
            $t->string('updated_by', 20);
            $t->dateTime('updated_on');
        });
    }

    public function down()
    {
        Schema::dropIfExists('working_day_time');
    }
}
