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
      $t->boolean('admin');
      $t->tinyInteger('membership_id');
      $t->string('designation', 30);
      $t->string('email', 100);
      $t->string('work', 30)->nullable();
      $t->string('mobile', 30);
      $t->char('preferred_contact', 1)->nullable();
      $t->string('updated_by', 20);
      $t->dateTime('updated_on');
      $t->dateTime('created_on');
      $t->softDeletes();
    });
  }
  
  public function down()
  {
    Schema::dropIfExists('requester');
  }
}
