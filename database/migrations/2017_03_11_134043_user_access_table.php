<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserAccessTable extends Migration
{
    public function up()
    {
        Schema::create('user_access', function(Blueprint $t) {
            $t->increments('user_access_id');
            $t->integer('user_id');
            $t->integer('access_id');
            $t->string('updated_by', 20);
            $t->dateTime('updated_on');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_access');
    }
}
