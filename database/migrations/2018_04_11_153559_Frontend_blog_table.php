<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FrontendBlogTable extends Migration
{
    public function up()
    {
      Schema::create('frontend_blog', function(Blueprint $t) {
        $t->increments('frontend_blog_id');
        $t->string('title', 50);
        $t->boolean('stat');
        $t->string('meta_title', 50);
        $t->string('meta_keyword', 100);
        $t->string('meta_desc', 250);
        $t->string('url', 50);
        $t->text('content');
      });
    }

    public function down()
    {
      Schema::dropIfExists('frontend_blog');
    }
}
