<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FrontendBannerTable extends Migration
{
  public function up()
  {
    Schema::create('frontend_banner', function (Blueprint $t) {
      $t->increments('frontend_banner_id');
      $t->string('title', 50);
      $t->string('content', 100);
      $t->string('button_text', 50);
      $t->string('link', 50);
      $t->string('image', 50);
    });

    DB::table('frontend_banner')->insert([
      'title'=>'HOME IMPROVEMENTS AND REMODELING',
      'content'=>'With over 15 years experience and real focus on customer satisfaction, you can rely on us for your next renovation, remodeling or driveway sett.',
      'button_text'=>'CONTACT US',
      'link'=>'contact',
      'image'=>'image_01.jpg',
    ]);
    DB::table('frontend_banner')->insert([
      'title'=>'PROFESSIONAL TILING AND PAINTING SERVICES',
      'content'=>'We combine quality workmanship, superior knowledge and low prices to provide you with service unmatched by our competitors.',
      'button_text'=>'CONTACT US',
      'link'=>'contact',
      'image'=>'image_02.jpg',
    ]);
    DB::table('frontend_banner')->insert([
      'title'=>'YOUR MOST AFFORDABLE CONTRACTORS',
      'content'=>'We have the experience, personel and resources to make the project run smoothly. We can ensure a job is done on time.',
      'button_text'=>'CONTACT US',
      'link'=>'contact',
      'image'=>'image_03.jpg',
    ]);

  }

  public function down()
  {
    Schema::dropIfExists('frontend_banner');
  }
}
