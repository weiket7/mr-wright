@extends('frontend.template', ['title'=>'about'])

@section('content')
  <div class="r-row">
    <div class="column column-1-2 align-center re-preload">
      <div class="image-wrapper">
        <img src="{{asset('assets/images/frontend/'.$frontend['contents']['about_page_image'])}}" alt="" class="radius">
      </div>
    </div>
    <div class="column column-1-2">
      <h2 class="box-header align-left"> {{$frontend['contents']['about_page_title']}}</h2>
      <div class="description t1">
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