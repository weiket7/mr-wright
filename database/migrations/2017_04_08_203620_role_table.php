<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RoleTable extends Migration
{
    public function up()
    {
        Schema::create('role', function(Blueprint $t) {
            $t->increments('role_id');
            $t->string('name', 50);
            $t->string('updated_by', 20);
            $t->dateTime('updated_on');
        });
    }

    public function down()
    {
        Schema::dropIfExists('role');
    }
}
