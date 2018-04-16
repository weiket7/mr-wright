@extends('frontend.template', [
  'title'=>'blog',
  'meta_title'=>$frontend['contents']['about_meta_title'],
  'meta_keyword'=>$frontend['contents']['about_keyword'],
  'meta_desc'=>$frontend['contents']['about_desc']
])

@section('content')
  <div class="row">
    @foreach($blog_chunks as $chunk)
      <ul class="blog two-columns clearfix">
        @foreach($chunk as $blog)
          <li class="column column-1-2" style="margin-bottom: 50px;">
            <ul class="post-details">
              <li class="date template-calendar">
                {{ date('M', strtotime($blog->posted_on)) }}
                <h2>{{ date('d', strtotime($blog->posted_on)) }}</h2>
                {{ date('Y', strtotime($blog->posted_on)) }}
              </li>
            </ul>
            <div class="post-content r-text">
              <a href="{{url('blog/'.$blog->slug)}}" title="{{ $blog->title }}" class="post-image">
                <img src="{{asset('assets/images/frontend/blogs/'.$blog->image)}}" alt="">
              </a>
              <h3 class="box-header align-left"><a href="{{url('blog/'.$blog->url)}}">{{ $blog->title }}</a></h3>
              <p class="description">
                {{ $blog->desc }}
              </p>
              <div class="padding-bottom-17" style="padding-top: 20px">
                <a class="more" href="{{url('blog/'.$blog->slug )}}" title="READ MORE">READ MORE</a>
              </div>
            </div>
          </li>
        @endforeach
      </ul>
    @endforeach
  </div>
@endsection