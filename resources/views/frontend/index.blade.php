@extends('frontend.template', [
  'meta_title'=>$frontend['contents']['home_meta_title'],
  'meta_keyword'=>$frontend['contents']['home_keyword'],
  'meta_desc'=>$frontend['contents']['home_desc']
])

@section('content')
  <!-- Slider Revolution -->
  <div class="revolution-slider-container">
    <div class="revolution-slider">
      <ul style="display: none;">
        @foreach($frontend["banners"] as $banner)
          <li data-transition="fade" data-masterspeed="500" data-slotamount="1" data-delay="6000">
            <img src="{{asset('assets/images/frontend/banners/'.$banner->image)}}" alt="slidebg1" data-bgfit="cover">
            
            <div class="tp-caption"
                 data-frames='[{"delay":500,"speed":1200,"from":"x:40;o:0;","ease":"easeInOutExpo"},{"delay":"wait","speed":500,"to":"o:0;","ease":"easeInOutExpo"}]'
                 data-x="0"
                 data-y="140"
            >
              <div class="slider-content-box">
                <h2><a href="{{url($banner->link)}}">{{$banner->title}}</a></h2>
                <p>{{$banner->content}}</p>
                <a target="_top" class="more simple" href="{{url($banner->link)}}">
                  {{$banner->button_text}}
                </a>
              </div>
            </div>
          </li>
        @endforeach
      </ul>
    </div>
  </div>
  <!--/-->
  
  <div class="theme-page">
    <div class="clearfix">
      <div class="r-row page-margin-top-section padding-bottom-66">
        <h2 class="box-header">{{$frontend['contents']['about_title']}}</h2>
        <div class="description align-center">{!! $frontend['contents']['about_content'] !!}</div>
        <div class="r-row page-margin-top">
          <div class="column column-1-4">
            <ul class="features-list big">
              <li class="sl-large-{{$frontend['contents']['about_column1_icon']}}">
                <div class="ornament"></div>
                <h4 class="box-header page-margin-top">{{$frontend['contents']['about_column1_title']}}</h4>
                <p>{!! $frontend['contents']['about_column1_content'] !!}</p>
              </li>
            </ul>
          </div>
          <div class="column column-1-4">
            <ul class="features-list big">
              <li class="sl-large-{{$frontend['contents']['about_column2_icon']}}">
                <div class="ornament"></div>
                <h4 class="box-header page-margin-top">{{$frontend['contents']['about_column2_title']}}</h4>
                <p>{!! $frontend['contents']['about_column2_content'] !!}</p>
              </li>
            </ul>
          </div>
          <div class="column column-1-4">
            <ul class="features-list big">
              <li class="sl-large-{{$frontend['contents']['about_column3_icon']}}">
                <div class="ornament"></div>
                <h4 class="box-header page-margin-top">{{$frontend['contents']['about_column3_title']}}</h4>
                <p>{!! $frontend['contents']['about_column3_content'] !!}</p>
              </li>
            </ul>
          </div>
          <div class="column column-1-4">
            <ul class="features-list big">
              <li class="sl-large-{{$frontend['contents']['about_column4_icon']}}">
                <div class="ornament"></div>
                <h4 class="box-header page-margin-top">{{$frontend['contents']['about_column4_title']}}</h4>
                <p>{!! $frontend['contents']['about_column4_content'] !!}</p>
              </li>
            </ul>
          </div>
        </div>
      
      </div>
      
      <div class="r-row full-width gray page-padding-top-section">
        <div class="r-row">
          <h2 class="box-header">{{$frontend['contents']['service_title']}}</h2>
          <div class="description align-center">{!! $frontend['contents']['service_content'] !!}</div>
          <ul class="services-list clearfix page-margin-top">
            @for($i=0; $i<=2; $i++)
            <li>
              <a href="{{ url("services/".$services[$i]->url) }}">
                <img src="{{url('assets/images/frontend/services/'.$services[$i]->image1)}}" alt="">
              </a>
              <h4 class="box-header"><a href="{{"services/".$services[$i]->url}}">{{ $services[$i]->title }}</a></h4>
              <p>{!! $frontend['contents']['service_column'.($i+1).'_content'] !!}</p>
            </li>
            @endfor
          </ul>
          <div class="align-center margin-top-67 padding-bottom-87">
            <a class="more" href="{{url('services')}}" title="VIEW ALL SERVICES">VIEW ALL SERVICES</a>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection