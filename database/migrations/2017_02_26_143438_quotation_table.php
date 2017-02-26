<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QuotationTable extends Migration
{
    public function up()
    {
        Schema::create('quotation', function(Blueprint $t) {
            $t->increments('quotation_id');
            $t->string('name', 50);
            $t->string('updated_by', 20);
            $t->dateTime('updated_on');
        });
    }

    public function down()
    {
        Schema::dropIfExists('quotation');
    }
}
