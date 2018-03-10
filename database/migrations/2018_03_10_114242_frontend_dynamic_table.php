<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FrontendDynamicTable extends Migration
{
  public function up()
  {
    Schema::create('frontend_dynamic', function (Blueprint $t) {
      $t->increments('frontend_dynamic_id');
      $t->string('title', 50);
      $t->boolean('stat');
      $t->string('meta_title', 50);
      $t->string('meta_keyword', 100);
      $t->string('meta_desc', 250);
      $t->boolean('has_contact');
      $t->string('url', 50);
      $t->text('content');
    });
    
    DB::table('frontend_dynamic')->insert([
      'title'=>'HOME IMPROVEMENTS AND REMODELING',
      'meta_title'=>'title',
      'meta_keyword'=>'keyword',
      'meta_desc'=>'desc',
      'has_contact'=>1,
      'url'=>'sms1',
      'content'=>'<p>The last time the power to your office tripped, or the plumbing in the toilet or pantry got clogged, work was disrupted and you scrambled to get a repair man over.</p><p>With Mr Wright’s online platform, all your service and repair needs can be solved with a push of a button! You are in control of how fast you want your request to be attended to! depending on your subscribed service plans, our team will attend to your request within 3 hours after you log a case in our system.</p><p>What’s more we’re so confident of our workmanship that a 12 months warranty is offered on all our services, parts and labour, a first in the industry!</p><p>To thank you for your business, we’re even throwing in points for every dollar you spend to exchange for services or gifts that you can use to reward your staff with our partner United Points. [Hyperlink to site] There is a catalogue of over 30000 gifts to choose from! What a great way to spend and earn all at once!</p><p>Interested to find out more? Leave us your contact and our friendly service team will connect with you shortly!</p>',
    ]);
    
  }
  
  public function down()
  {
    Schema::dropIfExists('frontend_dynamic');
  }
}
