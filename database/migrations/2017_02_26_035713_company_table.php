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
        $t->char('stat', 1);
        $t->string('code', 5);
        $t->string('name', 50);
        $t->string('registered_name', 100);
        $t->string('uen', 50);
        $t->string('logo', 50);
        $t->integer('office_count');
        $t->string('addr', 200);
        $t->string('country', 50);
        $t->string('state', 50);
        $t->string('city', 50);
        $t->string('postal', 20);
        $t->string('industry', 30);
        //$t->integer('membership_id');
        $t->integer('requester_count');
        $t->integer('requester_limit');
        $t->decimal('effective_price', 12, 2); //per month
        $t->string('updated_by', 20);
        $t->dateTime('updated_on');
      });
    }

    public function down()
    {
        Schema::dropIfExists('company');
    }
}
