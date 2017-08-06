@extends('frontend.template', ['title'=>'services / '.$current_service->title])

@section('content')
  <div class="column column-1-4">
    <ul class="vertical-menu">
      @foreach($services as $service)
        <li {{ $current_service->slug == $service->slug ? "class=selected" : "" }}>
          <a href="{{url('services/'.$service->slug)}}" title="Interior Renovation">
            {{ $service->title }}
            <span class="template-arrow-menu"></span>
          </a>
        </li>
      @endforeach
    </ul>
  </div>
  <div class="column column-3-4">
    <div class="r-row">
      <div class="column column-1-2">
        <a href="{{url('images/frontend/services/'.$current_service->image1)}}" class="prettyPhoto re-preload" title="{{$current_service->title}}">
          <img src='{{url('assets/images/frontend/services/'.$current_service->image1)}}' alt='img'>
        </a>
      </div>
      <div class="column column-1-2">
        <a href="{{url('images/frontend/services/'.$current_service->image2)}}" class="prettyPhoto re-preload" title="{{$current_service->title}}">
          <img src='{{url('assets/images/frontend/services/'.$current_service->image2)}}' alt='img'>
        </a>
      </div>
    </div>
    <div class="r-row page-margin-top">
      <div class="column-1-1">
        <h3 class="box-header">{{$current_service->title}}</h3>
        <div class="description t1">
          {!! $current_service->content !!}
        </div>
      </div>
    </div>
  </div>
@endsection