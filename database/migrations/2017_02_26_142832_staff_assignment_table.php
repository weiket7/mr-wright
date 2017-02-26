<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StaffAssignmentTable extends Migration
{
    public function up()
    {
        Schema::create('staff_assignment', function(Blueprint $t) {
            $t->increments('staff_assignment_id');
            $t->integer('staff_id');
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
        Schema::dropIfExists('staff_assignment');
    }
}
