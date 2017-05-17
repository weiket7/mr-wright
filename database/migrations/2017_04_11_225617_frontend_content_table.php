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
    $data = [
      ['key'=>'contact', 'value'=>'+65 3222 3512'],
      ['key'=>'email', 'value'=>'support@mrwright.sg'],
      ['key'=>'opening_hours', 'value'=>'Mon - Fri: 08.00 - 17.00'],
      ['key'=>'facebook', 'value'=>'http://facebook.com'],
      ['key'=>'twitter', 'value'=>'http://twitter.com'],
      ['key'=>'pinterest', 'value'=>'http://pinterest.com'],
      ['key'=>'linkedin', 'value'=>'http://linkedin.com'],
      ['key'=>'address', 'value'=>'272 Linden Avenue
Winter Park, FL 32789']
    ];
    foreach($data as $d) {
      DB::table('frontend_content')->insert([
        'page'=>'general', 'key'=>$d['key'], 'value'=>$d['value']
      ]);
    }

    $data = [
      ['key'=>'about_title', 'value'=>'WHY CHOOSE RENOVATE'],
      ['key'=>'about_content', 'value'=>'Founded by Kevin Smith back in 2000, Renovate has established itself as one of the greatest and prestigious
providers of construction focused interior renovation services and building.'],
      ['key'=>'about_column1_icon', 'value'=>'house-2'],
      ['key'=>'about_column1_title', 'value'=>'WE\'RE EXPERTS'],
      ['key'=>'about_column1_content', 'value'=>'Morbi nulla tortor, dignissim est node cursus euismod est arcu. Nomad at vehicula novum justo magna.'],
      ['key'=>'about_column2_icon', 'value'=>'team'],
      ['key'=>'about_column2_title', 'value'=>'WE\'RE FRIENDLY'],
      ['key'=>'about_column2_content', 'value'=>'Morbi nulla tortor, dignissim est node cursus euismod est arcu. Nomad at vehicula novum justo magna.'],
      ['key'=>'about_column3_icon', 'value'=>'measure'],
      ['key'=>'about_column3_title', 'value'=>'WE\'RE ACCURATE'],
      ['key'=>'about_column3_content', 'value'=>'Morbi nulla tortor, dignissim est node cursus euismod est arcu. Nomad at vehicula novum justo magna.'],
      ['key'=>'about_column4_icon', 'value'=>'brush-2'],
      ['key'=>'about_column4_title', 'value'=>'WE\'RE TRUSTED'],
      ['key'=>'about_column4_content', 'value'=>'Morbi nulla tortor, dignissim est node cursus euismod est arcu. Nomad at vehicula novum justo magna.'],
    ];
    foreach($data as $d) {
      DB::table('frontend_content')->insert([
        'page'=>'home', 'key'=>$d['key'], 'value'=>$d['value']
      ]);
    }

    /*HOME SERVICE*/
    $data = [
      ['key'=>'service_title', 'value'=>'OUR SERVICES'],
      ['key'=>'service_content', 'value'=>'With over 15 years experience and real focus on customer satisfaction, you can rely on us for your next renovation,
driveway sett or home repair. We provide a professional service for private and commercial customers.'],
      ['key'=>'service_column1_image', 'value'=>'service1.jpg'],
      ['key'=>'service_column1_title', 'value'=>'INTERIOR RENOVATION'],
      ['key'=>'service_column1_content', 'value'=>'We can help you bring new life to existing rooms and develop unused spaces.'],
      ['key'=>'service_column1_link', 'value'=>''],
      ['key'=>'service_column2_image', 'value'=>'service2.jpg'],
      ['key'=>'service_column2_title', 'value'=>'DESIGN AND BUILD'],
      ['key'=>'service_column2_content', 'value'=>'From initial design and project specification to archieving a high end finish.'],
      ['key'=>'service_column2_link', 'value'=>''],
      ['key'=>'service_column3_image', 'value'=>'service3.jpg'],
      ['key'=>'service_column3_title', 'value'=>'TILING AND PAINTING'],
      ['key'=>'service_column3_content', 'value'=>'We offer quality tiling and painting solutions for interior and exterior.'],
      ['key'=>'service_column3_link', 'value'=>''],
    ];
    foreach($data as $d) {
      DB::table('frontend_content')->insert([
        'page'=>'home', 'key'=>$d['key'], 'value'=>$d['value']
      ]);
    }

    /*PAYMENT*/
    $data = [
      ['key'=>'payment_cheque', 'value'=>'For cheque payment, please make it payable: <br>Mr Wright Pte Ltd'],
      ['key'=>'payment_cash', 'value'=>'For cash payment, please make payment at:<br>Mr Wright<br>Blk 100, #01-1345<br>123 Toa Payoh Rd, S123456'],
      ['key'=>'payment_banktransfer', 'value'=>'For bank transfer, please transfer to: <br>OCBC Corporate Current Account, 123-456-789<br>Bank Code: 1234 | Branch Code 4567'],
      ['key'=>'payment_nets', 'value'=>'For NETS, upon submitting, you will be prompted for payment.'],
      ['key'=>'payment_creditcard', 'value'=>'For credit card, upon submitting, you will be prompted for payment.'],
    ];
    foreach($data as $d) {
      DB::table('frontend_content')->insert(['page'=>'payment', 'key'=>$d['key'], 'value'=>$d['value']]);
    }


    /*FOOTER*/
    DB::table('frontend_content')->insert([
      'page'=>'general',
      'key'=>'footer_about',
      'value'=>'Founded by Kevin Smith back in 2000. Renovate has estabilished itself as one of the greatest and prestigious providers of construction focused interior renovation services and building.',
    ]);


    DB::table('frontend_content')->insert([
      'page'=>'about',
      'key'=>'about_title',
      'value'=>'WE ARE RENOVATE',
    ]);
    DB::table('frontend_content')->insert([
      'page'=>'about',
      'key'=>'about_content',
      'value'=>'Founded by Kevin Smith back in 2000, Renovate has established itself as one of the greatest and prestigious providers of construction focused interior renovation services and building. We provide a professional renovation and installation services with a real focus on customer satisfaction. Our construction Services is a multi-task company specializing in the following core areas:',
    ]);
    DB::table('frontend_content')->insert([
      'page'=>'about',
      'key'=>'about_line1',
      'value'=>'We combine Quality Workmanship, Superior Knowledge and Low Prices',
    ]);
    DB::table('frontend_content')->insert([
      'page'=>'about',
      'key'=>'about_line2',
      'value'=>'We Can Ensure a Job is Done on Time and on Budget',
    ]);
    DB::table('frontend_content')->insert([
      'page'=>'about',
      'key'=>'about_line3',
      'value'=>'Proven Results for Setting Exceptional Standards in Cost Control',
    ]);
    DB::table('frontend_content')->insert([
      'page'=>'about',
      'key'=>'about_line4',
      'value'=>'Professional Service for Private and Commercial Customers',
    ]);
    DB::table('frontend_content')->insert([
      'page'=>'about',
      'key'=>'about_line5',
      'value'=>'15 Years Experience and a Real Focus on Customer Satisfaction',
    ]);


  }

  public function down()
  {
    Schema::dropIfExists('frontend_content');
  }
}
