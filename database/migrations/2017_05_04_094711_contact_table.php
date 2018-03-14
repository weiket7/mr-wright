<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContactTable extends Migration
{
  public function up()
  {
    Schema::create('contact', function(Blueprint $t) {
      $t->increments('contact_id');
      $t->string('name', 50);
      $t->string('email', 100);
      $t->string('mobile', 30);
      $t->string('message', 250);
      $t->string('company_name', 50);
      $t->string('promo_code', 30);
      $t->string('source', 50);
      $t->dateTime('created_on');
    });
  }
  
  public function down()
  {
    Schema::dropIfExists('contact');
  }
}
