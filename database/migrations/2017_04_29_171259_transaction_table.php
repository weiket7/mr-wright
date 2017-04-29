<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TransactionTable extends Migration
{
    public function up()
    {
        Schema::create('transaction', function(Blueprint $t) {
            $t->increments('transaction_id');
            $t->string('code', 30);
            $t->string('ref_no', 30);
            $t->char('stat', 1);
            $t->char('type', 1);
            $t->decimal('amount', 9, 2);
            $t->char('payment_method', 1);
            $t->dateTime('created_on');
            $t->dateTime('updated_on');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaction');
    }
}
