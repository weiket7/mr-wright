<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteLogTable extends Migration
{
    public function up()
    {
      Schema::create('delete_log', function(Blueprint $t) {
        $t->increments('delete_log_id');
        $t->string('table_name', 50);
        $t->integer('id');
        $t->string('desc', 250);
        $t->string('deleted_by', 30);
        $t->dateTime('deleted_on');
      });
    }

    public function down()
    {
      Schema::dropIfExists('delete_log');
    }
}
