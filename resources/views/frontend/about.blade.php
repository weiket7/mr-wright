@extends('frontend.template')

@section('content')
  <div class="theme-page padding-bottom-66">
    <div class="row gray full-width page-header vertical-align-table">
      <div class="row full-width padding-top-bottom-50 vertical-align-cell">
        <div class="row">
          <div class="page-header-left">
            <h1>ABOUT US</h1>
          </div>
          <div class="page-header-right">
            <div class="bread-crumb-container">
              <label>You Are Here:</label>
              <ul class="bread-crumb">
                <li>
                  <a title="HOME" href="{{ url('/') }}">
                    HOME
                  </a>
                </li>
                <li class="separator">
                  &#47;
                </li>
                <li>
                  ABOUT US
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix">
      <div class="row margin-top-70">
        <div class="column column-1-2 align-center re-preload">
          <div class="image-wrapper">
            <img src="{{asset('images/frontend/about.jpg')}}" alt="" class="radius">
          </div>
        </div>
        <div class="column column-1-2">
          <h2 class="box-header align-left"> {{$frontend['contents']['about_title']}}</h2>
          <p class="description t1">Founded by Kevin Smith back in 2000, Renovate has established itself as one of the greatest and prestigious providers of construction focused interior renovation services and building. We provide a professional renovation and installation services with a real focus on customer satisfaction. Our construction Services is a multi-task company specializing in the following core areas:</p>
          <ul class="list margin-top-20">
            @for($i=1; $i<=5; $i++)
              @if($frontend['contents']['about_line'.$i])
                <li class="template-bullet">{{ $frontend['contents']['about_line'.$i] }}</li>
              @endif
            @endfor
          </ul>
          <div class="page-margin-top">
            <a class="more" href="services.html" title="OUR SERVICES">OUR SERVICES</a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection