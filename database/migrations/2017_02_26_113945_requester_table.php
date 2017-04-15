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
      $t->integer('office_id');
      $t->string('name', 50);
      $t->string('username', 30);
      $t->char('stat', 1);
      $t->char('type', 1);
      $t->string('designation', 30);
      $t->string('email', 100);
      $t->string('work', 20)->nullable();
      $t->string('mobile', 20);
      $t->string('company_name', 100)->nullable();
      $t->string('office_name', 100)->nullable();
      $t->string('addr', 200)->nullable();
      $t->string('postal', 20)->nullable();
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
