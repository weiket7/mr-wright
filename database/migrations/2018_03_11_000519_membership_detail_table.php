<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MembershipDetailTable extends Migration
{
  public function up()
  {
    Schema::create('membership_detail', function (Blueprint $table) {
      $table->increments('membership_detail_id');
      $table->integer('membership_id');
      $table->tinyInteger('position');
      $table->string('content', 250);
    });
  }
  
  public function down()
  {
    Schema::dropIfExists('membership_detail');
  }
}
