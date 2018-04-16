@extends('frontend.template', [
  'title'=>$blog->title,
  'meta_title'=>$blog->meta_title,
  'meta_keyword'=>$blog->meta_keyword,
  'meta_desc'=>$blog->meta_desc
])

@section('content')
  <div class="blog clearfix">
    <div class="post single">
      <ul class="post-details">
        <li class="date template-calendar">
          {{ date('M', strtotime($blog->posted_on)) }}
          <h2>{{ date('d', strtotime($blog->posted_on)) }}</h2>
          {{ date('Y', strtotime($blog->posted_on)) }}
        </li>
      </ul>
      <div class="post-content">
        <div title="{{ $blog->title }}" class="post-image">
          <img src="{{ asset('assets/images/blog/'.$blog->image) }}" alt="">
        </div>
        <h2 class="box-header align-left">WHAT A DIFFERENCE A FEW MONTHS MAKE</h2>
        <div class="description">
          {!! $blog->content !!}
        </div>
      </div>
    </div>
  </div>
@endsection