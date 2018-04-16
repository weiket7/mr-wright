<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FrontendBlogSeeder extends Seeder
{
    public function run()
    {
      DB::table('frontend_blog')->insert([
        'title'=>'WHAT A DIFFERENCE A FEW MONTHS MAKE',
        'slug'=>'what-a-difference-a-few-months-make',
        'desc'=>'Paetos dignissim at cursus elefeind norma arcu. Pellentesque mode accumsan est in tempus, etos at ullamcorper quam suscipit lacus maecenas tortor. Erates vitae node metus. Suspendisse est gravida ornare. Non mattis morbi suspendisse velit rutrum modest a tortor velim pellentesque uter justo magna gravida.',
        'image'=>'image_10.jpg',
        'posted_on'=>'admin',
        'posted_on'=>Carbon::now(),
      ]);
  
      DB::table('frontend_blog')->insert([
        'title'=>'KITCHEN AND LIVING ROOM RENOVATION',
        'slug'=>'kitchen-and-living-room-renovation',
        'desc'=>'Paetos dignissim at cursus elefeind norma arcu. Pellentesque mode accumsan est in tempus, etos at ullamcorper quam suscipit lacus maecenas tortor. Erates vitae node metus. Suspendisse est gravida ornare. Non mattis morbi suspendisse velit rutrum modest a tortor velim pellentesque uter justo magna gravida.',
        'image'=>'image_07.jpg',
        'posted_on'=>'admin',
        'posted_on'=>Carbon::now(),
      ]);
      
      DB::table('frontend_blog')->insert([
        'title'=>'SIGNS YOU NEED DRAIN REPAIR SERVICES',
        'slug'=>'signs-you-need-drain-repair-services',
        'desc'=>'Paetos dignissim at cursus elefeind norma arcu. Pellentesque mode accumsan est in tempus, etos at ullamcorper quam suscipit lacus maecenas tortor. Erates vitae node metus. Suspendisse est gravida ornare. Non mattis morbi suspendisse velit rutrum modest a tortor velim pellentesque uter justo magna gravida.',
        'image'=>'image_05.jpg',
        'posted_on'=>'admin',
        'posted_on'=>Carbon::now(),
      ]);
    }
}
