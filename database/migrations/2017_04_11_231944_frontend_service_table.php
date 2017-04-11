<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FrontendServiceTable extends Migration
{
    public function up()
    {
        Schema::create('frontend_service', function (Blueprint $t) {
            $t->increments('service_id');
            $t->string('title', 50);
            $t->string('content', 100);
            $t->string('button_text', 50);
            $t->string('button_link', 50);
            $t->string('image', 50);
        });

    }

    public function down()
    {
        Schema::dropIfExists('frontend_service');

    }
}
