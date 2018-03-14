@extends('frontend.template', [
  'title'=>'about',
  'meta_title'=>$frontend['contents']['about_meta_title'],
  'meta_keyword'=>$frontend['contents']['about_keyword'],
  'meta_desc'=>$frontend['contents']['about_desc']
])

@section('content')
  <style>
    .videoWrapper {
      position: relative;
      padding-bottom: 56.25%; /* 16:9 */
      padding-top: 25px;
      height: 0;
    }
    .videoWrapper iframe {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
    }
  </style>
  
  <div class="r-row">
    <div class="column column-1-2 align-center re-preload">
      {{--<div class="image-wrapper">
        <img src="{{asset('assets/images/frontend/'.$frontend['contents']['about_page_image'])}}" alt="" class="radius">
      </div>
  --}}
      <div class="videoWrapper">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/5epbXWqVyv0?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
      </div>
    </div>
    <div class="column column-1-2">
      <h2 class="box-header align-left"> {{$frontend['contents']['about_page_title']}}</h2>
      <div class="description about-content">
        {!! ($frontend['contents']['about_page_content']) !!}
      </div>
      <ul class="list margin-top-20">
        @for($i=1; $i<=5; $i++)
          @if ($frontend['contents']['about_line'.$i])
            <li class="template-bullet">{{ $frontend['contents']['about_line'.$i] }}</li>
          @endif
        @endfor
      </ul>
      <div class="page-margin-top">
        <a class="more" href="{{url('services')}}" title="OUR SERVICES">OUR SERVICES</a>
      </div>
    </div>
  </div>
@endsection