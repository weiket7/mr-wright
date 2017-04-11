<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FrontendProjectTable extends Migration
{
  public function up()
  {
    Schema::create('frontend_project', function (Blueprint $t) {
      $t->increments('project_id');
      $t->string('title', 50);
      $t->string('content', 1000);
      $t->string('category', 30);
      $t->string('image_top', 50);
      $t->string('image_left', 50);
      $t->string('image_right', 50);
      $t->string('row1_left', 50);
      $t->string('row1_right', 50);
      $t->string('row2_left', 50);
      $t->string('row2_right', 50);
      $t->string('row3_left', 50);
      $t->string('row3_right', 50);
      $t->string('row4_left', 50);
      $t->string('row4_right', 50);
      $t->string('row5_left', 50);
      $t->string('row5_right', 50);
    });

    DB::table('frontend_project')->insert([
      'title'=>'DESIGN AND BUILD',
      'content'=>'Paetos dignissim at cursus elefeind norma arcu. Pellentesque accumsan est in tempus etos ullamcorper, sem quam suscipit lacus maecenas tortor. Erates vitae node metus. Suspendisse gravida ornare non mattis velit rutrum modest. Morbi suspendisse a tortor velim pellentesque uter justo magna gravida.',
      'row1_left'=>'Project Type',
      'row1_right'=>'Office Building',
      'row2_left'=>'Client',
      'row2_right'=>'New York City',
      'row3_left'=>'Completion Date',
      'row3_right'=>'August 2008',
      'row4_left'=>'Project Size',
      'row4_right'=>'3350 Square Feet',
      'row5_left'=>'Contract Value',
      'row5_right'=>'	$10,250,000',
    ]);
  }

  public function down()
  {
    Schema::dropIfExists('frontend_project');
  }
}
