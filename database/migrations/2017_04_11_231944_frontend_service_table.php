<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FrontendServiceTable extends Migration
{
  public function up()
  {
    Schema::create('frontend_service', function (Blueprint $t) {
      $t->increments('frontend_service_id');
      $t->string('title', 50);
      $t->string('content', 100);
      $t->string('image1', 50);
      $t->string('image2', 50);
    });

    $data = [
      ['title'=>'Interior Renovation', 'image1'=>'image_01.jpg', 'image2'=>'image_07.jpg',
        'content'=>'When it comes to choosing a renovator to transfor the interior of your home, quality and trust should never be compromised. Working with a professional is an absolute must. With over 15 years experience and a real focus on customer satisfaction, you can rely on us for your next renovation, driveway sett on home repair. Our installations are carried out by fully trained staff to the highest professional standards. Always on time and on budget.
Renovate has proven results for setting exceptional standards in cost control, planning, scheduling and project safety. We have experience that gives us a competitive advantage over others in our field.'],
      ['title'=>'Design and Build', 'image1'=>'image_01.jpg', 'image2'=>'image_07.jpg',
        'content'=>'When it comes to choosing a renovator to transfor the interior of your home, quality and trust should never be compromised. Working with a professional is an absolute must. With over 15 years experience and a real focus on customer satisfaction, you can rely on us for your next renovation, driveway sett on home repair. Our installations are carried out by fully trained staff to the highest professional standards. Always on time and on budget.
Renovate has proven results for setting exceptional standards in cost control, planning, scheduling and project safety. We have experience that gives us a competitive advantage over others in our field.'],
      ['title'=>'Tiling and Painting', 'image1'=>'image_01.jpg', 'image2'=>'image_07.jpg',
        'content'=>'When it comes to choosing a renovator to transfor the interior of your home, quality and trust should never be compromised. Working with a professional is an absolute must. With over 15 years experience and a real focus on customer satisfaction, you can rely on us for your next renovation, driveway sett on home repair. Our installations are carried out by fully trained staff to the highest professional standards. Always on time and on budget.
Renovate has proven results for setting exceptional standards in cost control, planning, scheduling and project safety. We have experience that gives us a competitive advantage over others in our field.'],
      ['title'=>'Household Repair', 'image1'=>'image_01.jpg', 'image2'=>'image_07.jpg',
        'content'=>'When it comes to choosing a renovator to transfor the interior of your home, quality and trust should never be compromised. Working with a professional is an absolute must. With over 15 years experience and a real focus on customer satisfaction, you can rely on us for your next renovation, driveway sett on home repair. Our installations are carried out by fully trained staff to the highest professional standards. Always on time and on budget.
Renovate has proven results for setting exceptional standards in cost control, planning, scheduling and project safety. We have experience that gives us a competitive advantage over others in our field.'],
      ['title'=>'Solar Systems', 'image1'=>'image_01.jpg', 'image2'=>'image_07.jpg',
        'content'=>'When it comes to choosing a renovator to transfor the interior of your home, quality and trust should never be compromised. Working with a professional is an absolute must. With over 15 years experience and a real focus on customer satisfaction, you can rely on us for your next renovation, driveway sett on home repair. Our installations are carried out by fully trained staff to the highest professional standards. Always on time and on budget.
Renovate has proven results for setting exceptional standards in cost control, planning, scheduling and project safety. We have experience that gives us a competitive advantage over others in our field.'],
    ];

    foreach($data as $d) {
      DB::table('frontend_service')->insert($d);
    }
  }

  public function down()
  {
    Schema::dropIfExists('frontend_service');
  }
}
