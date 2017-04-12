<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FrontendContentTable extends Migration
{
  public function up()
  {
    Schema::create('frontend_content', function (Blueprint $t) {
      $t->increments('frontend_content_id');
      $t->string('page', 50);
      $t->string('key', 50);
      $t->string('value', 1000);
    });

    /*GENERAL*/
    DB::table('frontend_content')->insert([
      'page'=>'general',
      'key'=>'contact',
      'value'=>'+65 3222 3512',
    ]);
    DB::table('frontend_content')->insert([
      'page'=>'general',
      'key'=>'email',
      'value'=>'renovate@mail.com',
    ]);
    DB::table('frontend_content')->insert([
      'page'=>'general',
      'key'=>'opening_hours',
      'value'=>'Mon - Fri: 08.00 - 17.00',
    ]);
    DB::table('frontend_content')->insert([
      'page'=>'general',
      'key'=>'facebook',
      'value'=>'http://facebook.com',
    ]);

    /*HOME ABOUT*/
    DB::table('frontend_content')->insert([
      'key'=>'about_row1_title', 'page'=>'home',
      'value'=>'OVER 15 YEARS EXPERIENCE',
    ]);
    DB::table('frontend_content')->insert([
      'key'=>'about_row1_content', 'page'=>'home',
      'value'=>'We combine quality workmanship, superior knowledge and low prices to provide you with service unmatched by our competitors.',
    ]);
    DB::table('frontend_content')->insert([
      'key'=>'about_row2_title', 'page'=>'home',
      'value'=>'BEST MATERIALS',
    ]);
    DB::table('frontend_content')->insert([
      'key'=>'about_row2_content', 'page'=>'home',
      'value'=>'We have the experience, personel and resources to make the project run smoothly. We can ensure a job is done on time.',
    ]);
    DB::table('frontend_content')->insert([
      'key'=>'about_row3_title', 'page'=>'home',
      'value'=>'PROFESSIONAL STANDARDS',
    ]);
    DB::table('frontend_content')->insert([
      'key'=>'about_row3_content', 'page'=>'home',
      'value'=>'Work with us involve a carefully planned series of steps, centered around a schedule we stick to and daily communication.',
    ]);

    /*HOME SERVICE*/
    DB::table('frontend_content')->insert([
      'page'=>'home',
      'key'=>'service_column1_image',
      'value'=>'house-1',
    ]);
    DB::table('frontend_content')->insert([
      'page'=>'home',
      'key'=>'service_column1_title',
      'value'=>'INTERIOR RENOVATION',
    ]);
    DB::table('frontend_content')->insert([
      'page'=>'home',
      'key'=>'service_column1_content',
      'value'=>'',
    ]);
    DB::table('frontend_content')->insert([
      'page'=>'home',
      'key'=>'service_column2_image',
      'value'=>'eco',
    ]);
    DB::table('frontend_content')->insert([
      'page'=>'home',
      'key'=>'service_column2_title',
      'value'=>'DESIGN AND BUILD',
    ]);
    DB::table('frontend_content')->insert([
      'page'=>'home',
      'key'=>'service_column2_content',
      'value'=>'Morbi nulla tortor, dignissim est node cursus euismod est arcu. Nomad at vehicula novum justo magna.',
    ]);
    DB::table('frontend_content')->insert([
      'page'=>'home',
      'key'=>'service_column3_image',
      'value'=>'garage',
    ]);
    DB::table('frontend_content')->insert([
      'page'=>'home',
      'key'=>'service_column3_title',
      'value'=>'TILING AND PAINTING',
    ]);
    DB::table('frontend_content')->insert([
      'page'=>'home',
      'key'=>'service_column3_content',
      'value'=>'Morbi nulla tortor, dignissim est node cursus euismod est arcu. Nomad at vehicula novum justo magna.',
    ]);

    /*HOME WHY CHOOSE*/
    DB::table('frontend_content')->insert([
      'page'=>'home',
      'key'=>'whychoose_title',
      'value'=>'WHY CHOOSE RENOVATE',
    ]);
    DB::table('frontend_content')->insert([
      'page'=>'home',
      'key'=>'whychoose_content',
      'value'=>'Founded by Kevin Smith back in 2000, Renovate has established itself as one of the greatest and prestigious
providers of construction focused interior renovation services and building.',
    ]);
    DB::table('frontend_content')->insert([
      'page'=>'home',
      'key'=>'whychoose_column1_icon',
      'value'=>'house-1',
    ]);
    DB::table('frontend_content')->insert([
      'page'=>'home',
      'key'=>'whychoose_column1_title',
      'value'=>'OVER 15 YEARS EXPERIENCE',
    ]);
    DB::table('frontend_content')->insert([
      'page'=>'home',
      'key'=>'whychoose_column1_content',
      'value'=>'Morbi nulla tortor, dignissim est node cursus euismod est arcu. Nomad at vehicula novum justo magna.',
    ]);
    DB::table('frontend_content')->insert([
      'page'=>'home',
      'key'=>'whychoose_column2_icon',
      'value'=>'eco',
    ]);
    DB::table('frontend_content')->insert([
      'page'=>'home',
      'key'=>'whychoose_column2_title',
      'value'=>'BEST MATERIALS',
    ]);
    DB::table('frontend_content')->insert([
      'page'=>'home',
      'key'=>'whychoose_column2_content',
      'value'=>'Morbi nulla tortor, dignissim est node cursus euismod est arcu. Nomad at vehicula novum justo magna.',
    ]);
    DB::table('frontend_content')->insert([
      'page'=>'home',
      'key'=>'whychoose_column3_icon',
      'value'=>'garage',
    ]);
    DB::table('frontend_content')->insert([
      'page'=>'home',
      'key'=>'whychoose_column3_title',
      'value'=>'PROFESSIONAL STANDARDS',
    ]);
    DB::table('frontend_content')->insert([
      'page'=>'home',
      'key'=>'whychoose_column3_content',
      'value'=>'Morbi nulla tortor, dignissim est node cursus euismod est arcu. Nomad at vehicula novum justo magna.',
    ]);


    /*FOOTER*/
    DB::table('frontend_content')->insert([
      'page'=>'general',
      'key'=>'footer_about',
      'value'=>'Founded by Kevin Smith back in 2000. Renovate has estabilished itself as one of the greatest and prestigious providers of construction focused interior renovation services and building.',
    ]);


    DB::table('frontend_content')->insert([
      'page'=>'about',
      'key'=>'title',
      'value'=>'WE ARE RENOVATE',
    ]);
    DB::table('frontend_content')->insert([
      'page'=>'about',
      'key'=>'content',
      'value'=>'Founded by Kevin Smith back in 2000, Renovate has established itself as one of the greatest and prestigious providers of construction focused interior renovation services and building. We provide a professional renovation and installation services with a real focus on customer satisfaction. Our construction Services is a multi-task company specializing in the following core areas:',
    ]);
    DB::table('frontend_content')->insert([
      'page'=>'about',
      'key'=>'line1',
      'value'=>'We combine Quality Workmanship, Superior Knowledge and Low Prices',
    ]);
    DB::table('frontend_content')->insert([
      'page'=>'about',
      'key'=>'line2',
      'value'=>'We Can Ensure a Job is Done on Time and on Budget',
    ]);
    DB::table('frontend_content')->insert([
      'page'=>'about',
      'key'=>'line3',
      'value'=>'Proven Results for Setting Exceptional Standards in Cost Control',
    ]);
    DB::table('frontend_content')->insert([
      'page'=>'about',
      'key'=>'line4',
      'value'=>'Professional Service for Private and Commercial Customers',
    ]);
    DB::table('frontend_content')->insert([
      'page'=>'about',
      'key'=>'line5',
      'value'=>'15 Years Experience and a Real Focus on Customer Satisfaction',
    ]);


  }

  public function down()
  {
    Schema::dropIfExists('frontend_content');
  }
}
