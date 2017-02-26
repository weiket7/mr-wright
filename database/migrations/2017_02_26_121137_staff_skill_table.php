<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StaffSkillTable extends Migration
{
    public function up()
    {
        Schema::create('staff_skill', function(Blueprint $t) {
            $t->increments('staff_skill_id');
            $t->string('staff_id', 50);
            $t->string('skill_id', 50);
            $t->string('updated_by', 20);
            $t->dateTime('updated_on');
        });
    }

    public function down()
    {
        Schema::dropIfExists('staff_skill');
    }
}
