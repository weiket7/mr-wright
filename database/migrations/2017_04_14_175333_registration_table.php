<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RegistrationTable extends Migration
{
  public function up()
  {
    Schema::create('registration', function(Blueprint $t) {
      $t->increments('registration_id');
      $t->string('registration_code', 20);
      $t->char('stat', 1);
      $t->string('username', 20);
      $t->string('email', 100);
      $t->string('password', 60);
      $t->string('name', 50);
      $t->string('designation', 30);
      $t->string('mobile', 100);
      $t->string('uen', 50);
      $t->string('company_name', 50);
      $t->string('company_code', 5);
      //$t->string('office_name', 100);
      $t->string('addr', 200);
      $t->string('postal', 20);
      $t->boolean('existing_uen');
      $t->integer('membership_id');
      $t->string('membership_name', 50);
      $t->string('membership_full_name', 100);
      $t->integer('requester_limit');
      $t->decimal('effective_price', 9, 2);
      $t->char('payment_method', 1);
      //$t->boolean('approved');
      $t->string('ip', 40);
      $t->integer('company_id')->nullable();
      $t->integer('office_id')->nullable();
      $t->integer('requester_id')->nullable();
      $t->dateTime('created_on');
      $t->dateTime('updated_on');
    });
  }
  
  public function down()
  {
    Schema::dropIfExists('registration');
  }
}
