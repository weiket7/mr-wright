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
      $t->text('value');
      $t->boolean('is_image');
      $t->boolean('plain');
      $t->string('dimension');
    });
    
    /*GENERAL*/
    $data = [
      ['key'=>'contact', 'value'=>'+65 3222 3512'],
      ['key'=>'email', 'value'=>'sales@mrwright.sg'],
      ['key'=>'opening_hours', 'value'=>'Mon - Fri: 08.00 - 17.00'],
      ['key'=>'facebook', 'value'=>'http://facebook.com'],
      ['key'=>'twitter', 'value'=>'http://twitter.com'],
      ['key'=>'pinterest', 'value'=>'http://pinterest.com']       ,
      ['key'=>'linkedin', 'value'=>'http://linkedin.com'],
      ['key'=>'address', 'value'=>'272 Linden Avenue <br>Winter Park, FL 32789'],
      ['key'=>'rewards', 'value'=>'http://corporate.united-points.com/rewards/15/OWT3gK8wOKhZxRlHIszd/detail']
    ];
    foreach($data as $d) {
      DB::table('frontend_content')->insert([
        'page'=>'general', 'key'=>$d['key'], 'value'=>$d['value'],
        'is_image'=>isset($d['is_image']) ? $d['is_image'] : 0,
        'dimension'=>isset($d['dimension']) ? $d['dimension'] : 0,
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
      ['key'=>'service_column1_content', 'value'=>'We can help you bring new life to existing rooms and develop unused spaces.'],
      ['key'=>'service_column2_content', 'value'=>'From initial design and project specification to archieving a high end finish.'],
      ['key'=>'service_column3_content', 'value'=>'We offer quality tiling and painting solutions for interior and exterior.'],
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
    
    /*MEMBERSHIP*/
    DB::table('frontend_content')->insert([
      'page'=>'membership',
      'key'=>'membership_content',
      'value'=>'Only 3 steps to fixing your urgent repair work:<br>
Step 1: Login to Account<br>
Step 2: Report Fault Online<br>
Step 3: Accept Quotation by Email',
    ]);
    DB::table('frontend_content')->insert([
      'page'=>'membership',
      'key'=>'membership_detail',
      'value'=>'For full list of details, please check out the details here.',
    ]);
    
    /*MEMBERS*/
    DB::table('frontend_content')->insert([
      'page'=>'members',
      'key'=>'invite_content',
      'value'=>'To invite your colleague to Mr Wright under your membership plan, fill in his email below.<br>An email to be sent to him and he will be asked to fill in his details.',
    ]);
    
    /*ABOUT*/
    DB::table('frontend_content')->insert([
      'page'=>'about',
      'key'=>'about_page_content',
      'value'=>'Founded by Kevin Smith back in 2000, Renovate has established itself as one of the greatest and prestigious providers of construction focused interior renovation services and building. We provide a professional renovation and installation services with a real focus on customer satisfaction. Our construction Services is a multi-task company specializing in the following core areas:',
    ]);
    DB::table('frontend_content')->insert([
      'page'=>'about',
      'key'=>'about_page_image',
      'value'=>'about_page_image.jpg',
      'is_image'=>true,
      'dimension'=>'480 x 480px'
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
    
    /*FOOTER*/
    DB::table('frontend_content')->insert([
      'page'=>'general',
      'key'=>'footer_about',
      'value'=>'Founded by Kevin Smith back in 2000. Renovate has estabilished itself as one of the greatest and prestigious providers of construction focused interior renovation services and building.',
    ]);
    DB::table('frontend_content')->insert([
      'page'=>'about',
      'key'=>'about_page_title',
      'value'=>'WE ARE RENOVATE',
    ]);
    
    /*TERMS AND CONDITIONS*/
    DB::table('frontend_content')->insert([
      'page'=>'terms_and_conditions',
      'key'=>'terms_and_conditions',
      'value'=>
        '<b>Terms of this Agreement</b>
    
<p>III. 	The term of this Agreement (Henceforth referred to as the “Term”) will begin on the date of this Agreement and will remain in full force and effect until the completion of the Services, subject to earlier termination as provided in this Agreement.</p>

<p>IV.  	The Contractor shall make all reasonable efforts to repair the Client’s premises subject to the availability of any parts required and/or the terms of any relevant guarantee or warranty.</p>

<p>IV. 	In the event that either Party wishes to terminate this Agreement prior to the completion of the Services, the Party will be required to provide 10 days written notice to the other Party.</p>

<p>V. 	The Client will be invoiced when the Services are completed.

<p>VI. 	Invoices submitted by the Contractor to the Client are due within 30 days of receipt.

<p>VII. 	In the event that this Agreement is terminated by the Client prior to completion of the Services, but where the Services have been partially performed, the Contractor will charge 100 % of the fee to the Client.</p>

<b>Currency</b>
<p>VII. 	All monetary amounts referred to in this Agreement are in SGD (Singapore Dollars).</p>

<b>Indemnification</b>
<p>IX. 	The Client agrees to indemnify and hold harmless the Contractor against all losses, damages, liabilities, penalties or expenses of any kind, which may arise of any act of the Contractor.</p>
'
    ]);
    
    /*SEO*/
    $data = [
      ['page'=>'home', 'plain'=>1, 'key'=>'home_meta_title', 'value'=>'Singapore Business Office Repair Handyman Services & Handyman Repairs'],
      ['page'=>'home', 'plain'=>1, 'key'=>'home_keyword', 'value'=>'Handyman Services Singapore | Business Office Repairs Singapore | Handyman Repair Singapore'],
      ['page'=>'home', 'plain'=>1, 'key'=>'home_desc', 'value'=>'Handyman services in Singapore including business & office repair, plumbing & electrical repair. Call +65 6467 0396 for convenient and responsive handyman repairs.'],
      ['page'=>'about', 'plain'=>1, 'key'=>'about_meta_title', 'value'=>'Singapore Business Office Repair Handyman Services & Handyman Repairs'],
      ['page'=>'about', 'plain'=>1, 'key'=>'about_keyword', 'value'=>'Handyman Services Singapore | Business Office Repairs Singapore | Handyman Repair Singapore'],
      ['page'=>'about', 'plain'=>1, 'key'=>'about_desc', 'value'=>'Handyman services in Singapore including business & office repair, plumbing & electrical repair. Call +65 6467 0396 for convenient and responsive handyman repairs.'],
      ['page'=>'service', 'plain'=>1, 'key'=>'service_meta_title', 'value'=>'Singapore Business Office Repair Handyman Services & Handyman Repairs'],
      ['page'=>'service', 'plain'=>1, 'key'=>'service_keyword', 'value'=>'Handyman Services Singapore | Business Office Repairs Singapore | Handyman Repair Singapore'],
      ['page'=>'service', 'plain'=>1, 'key'=>'service_desc', 'value'=>'Handyman services in Singapore including business & office repair, plumbing & electrical repair. Call +65 6467 0396 for convenient and responsive handyman repairs.'],
      ['page'=>'membership', 'plain'=>1, 'key'=>'membership_meta_title', 'value'=>'Singapore Business Office Repair Handyman Services & Handyman Repairs'],
      ['page'=>'membership', 'plain'=>1, 'key'=>'membership_keyword', 'value'=>'Handyman Services Singapore | Business Office Repairs Singapore | Handyman Repair Singapore'],
      ['page'=>'membership', 'plain'=>1, 'key'=>'membership_desc', 'value'=>'Handyman services in Singapore including business & office repair, plumbing & electrical repair. Call +65 6467 0396 for convenient and responsive handyman repairs.'],
      ['page'=>'contact', 'plain'=>1, 'key'=>'contact_meta_title', 'value'=>'Singapore Business Office Repair Handyman Services & Handyman Repairs'],
      ['page'=>'contact', 'plain'=>1, 'key'=>'contact_keyword', 'value'=>'Handyman Services Singapore | Business Office Repairs Singapore | Handyman Repair Singapore'],
      ['page'=>'contact', 'plain'=>1, 'key'=>'contact_desc', 'value'=>'Handyman services in Singapore including business & office repair, plumbing & electrical repair. Call +65 6467 0396 for convenient and responsive handyman repairs.'],
    ];
    foreach($data as $d) {
      DB::table('frontend_content')->insert([
        'page' => 'general', 'key' => $d['key'], 'value' => $d['value'], 'plain' => $d['plain']
      ]);
    }
  }
  
  public function down()
  {
    Schema::dropIfExists('frontend_content');
  }
}
