<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CompanyTable extends Migration
{
    public function up()
    {
      Schema::create('company', function(Blueprint $t) {
        $t->increments('company_id');
        $t->string('name', 50);
        $t->string('updated_by', 20);
        $t->dateTime('updated_on');
      });
    }

    public function down()
    {
        Schema::dropIfExists('company');
    }
}
