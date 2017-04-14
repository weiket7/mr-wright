@extends('frontend.template')

@section('content')

  <div class="theme-page">
    <div class="r-row gray full-width page-header vertical-align-table">
      <div class="r-row full-width padding-top-bottom-50 vertical-align-cell">
        <div class="r-row">
          <div class="page-header-left">
            <h1>Services / {{$current_service->title}}</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix">
      <div class="r-row margin-top-70 padding-bottom-70">
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
                <img src='{{url('images/frontend/services/'.$current_service->image1)}}' alt='img'>
              </a>
            </div>
            <div class="column column-1-2">
              <a href="{{url('images/frontend/services/'.$current_service->image2)}}" class="prettyPhoto re-preload" title="{{$current_service->title}}">
                <img src='{{url('images/frontend/services/'.$current_service->image2)}}' alt='img'>
              </a>
            </div>
          </div>
          <div class="r-row page-margin-top">
            <div class="column-1-1">
              <h3 class="box-header">{{$current_service->title}}</h3>
              <p class="description t1">
                {!! nl2br($current_service->content) !!}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection