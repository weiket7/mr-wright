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
      $t->integer('ticket_id');
      $t->string('ticket_code', 15);
      $t->char('stat', 1);
      $t->integer('staff_id');
      $t->string('staff_username', 30);
      $t->string('staff_name', 50);
      $t->string('staff_mobile', 30);
      $t->date('date');
      $t->time('time_start');
      $t->time('time_end');
    });
  }

  public function down()
  {
    Schema::dropIfExists('staff_assignment');
  }
}
