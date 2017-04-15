<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RegisterTable extends Migration
{
    public function up()
    {
        Schema::create('register', function(Blueprint $t) {
            $t->increments('register_id');
            $t->string('username', 20);
            $t->string('password', 60);
            $t->string('name', 50);
            $t->string('designation', 50);
            $t->string('mobile', 100);
            $t->string('email', 100);
            $t->string('company_name', 100);
            $t->string('office_name', 100);
            $t->string('addr', 200);
            $t->string('postal', 20);
            $t->dateTime('created_on');
        });
    }

    public function down()
    {
        Schema::dropIfExists('register');
    }
}
