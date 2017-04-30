<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MembershipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
  {
    Schema::create('membership', function (Blueprint $table) {
      $table->increments('membership_id');
      $table->char('stat', 1);
      $table->string('name', 50);
      $table->integer('requester_limit');
      $table->decimal('effective_price', 9, 2); //per month
      $table->string('full_name', 100);
      $table->integer('position');
    });
  }
  
  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('membership');
  }
}
