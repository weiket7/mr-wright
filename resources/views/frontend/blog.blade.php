@extends('frontend.template', [
  'title'=>'blog',
  'meta_title'=>$frontend['contents']['about_meta_title'],
  'meta_keyword'=>$frontend['contents']['about_keyword'],
  'meta_desc'=>$frontend['contents']['about_desc']
])

@section('content')
  <div class="row">
    <ul class="blog two-columns clearfix">
      @foreach($blogs as $blog)
        <li class="column column-1-2">
          <ul class="post-details">
            <li class="date template-calendar">Apr<h2>25</h2>2015</li>
            <li class="template-eye">2 325</li>
          </ul>
          <div class="post-content r-text">
            <a href="{{url('blog/'.$blog->url)}}" title="{{ $blog->title }}" class="post-image">
              <img src="{{asset('assets/images/frontend/blogs/'.$blog->image)}}" alt="">
            </a>
            <h3 class="box-header align-left"><a href="{{url('blog/'.$blog->url)}}">{{ $blog->title }}</a></h3>
            <p class="description t1">
              {{ $blog->desc }}
            </p>
            <div class="padding-top-54 padding-bottom-17">
              <a class="more" href="{{url('blog/'.$blog->url )}}" title="READ MORE">READ MORE</a>
            </div>
          </div>
        </li>
      @endforeach
    </ul>
  </div>
@endsection