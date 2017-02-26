<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserTable extends Migration
{
    public function up()
    {
        Schema::create('user', function(Blueprint $t) {
            $t->increments('user_id');
            $t->string('username', 50);
            $t->string('name', 50);
            $t->char('type', 1);
            $t->string('updated_by', 20);
            $t->dateTime('updated_on');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user');
    }
}
