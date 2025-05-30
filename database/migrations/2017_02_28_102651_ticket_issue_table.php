<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TicketIssueTable extends Migration
{
  public function up()
  {
    Schema::create('ticket_issue', function (Blueprint $t) {
      $t->increments('ticket_issue_id');
      $t->integer('ticket_id');
      $t->string('image', 50);
      $t->string('issue_desc', 50);
      $t->string('expected_desc', 50);
    });
  }
  
  public function down()
  {
    Schema::dropIfExists('ticket_issue');
    
  }
}
