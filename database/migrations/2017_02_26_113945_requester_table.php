<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RequesterTable extends Migration
{
    public function up()
    {
        Schema::create('requester', function(Blueprint $t) {
            $t->increments('requester_id');
            $t->integer('company_id');
            $t->string('username', 50);
            $t->string('name', 50);
            $t->string('email', 50);
            $t->string('office', 20);
            $t->string('mobile', 20);
            $t->char('preferred_contact', 1);
            $t->string('updated_by', 20);
            $t->dateTime('updated_on');
        });
    }

    public function down()
    {
        Schema::dropIfExists('requester');
    }
}
