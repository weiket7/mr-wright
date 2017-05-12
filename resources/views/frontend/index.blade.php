@extends('frontend.template')

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
        <h2 class="box-header">WHY CHOOSE RENOVATE</h2>
        <p class="description align-center">Founded by Kevin Smith back in 2000, Renovate has established itself as one of the greatest and prestigious<br>providers of construction focused interior renovation services and building.</p>
        <div class="r-row page-margin-top">
          <div class="column column-1-4">
            <ul class="features-list big">
              <li class="sl-large-{{$frontend['contents']['about_column1_icon']}}">
                <div class="ornament"></div>
                <h4 class="box-header page-margin-top">{{$frontend['contents']['about_column1_title']}}</h4>
                <p>{{$frontend['contents']['about_column1_content']}}</p>
              </li>
            </ul>
          </div>
          <div class="column column-1-4">
            <ul class="features-list big">
              <li class="sl-large-{{$frontend['contents']['about_column2_icon']}}">
                <div class="ornament"></div>
                <h4 class="box-header page-margin-top">{{$frontend['contents']['about_column2_title']}}</h4>
                <p>{{$frontend['contents']['about_column2_content']}}</p>
              </li>
            </ul>
          </div>
          <div class="column column-1-4">
            <ul class="features-list big">
              <li class="sl-large-{{$frontend['contents']['about_column3_icon']}}">
                <div class="ornament"></div>
                <h4 class="box-header page-margin-top">{{$frontend['contents']['about_column3_title']}}</h4>
                <p>{{$frontend['contents']['about_column3_content']}}</p>
              </li>
            </ul>
          </div>
          <div class="column column-1-4">
            <ul class="features-list big">
              <li class="sl-large-{{$frontend['contents']['about_column4_icon']}}">
                <div class="ornament"></div>
                <h4 class="box-header page-margin-top">{{$frontend['contents']['about_column4_title']}}</h4>
                <p>{{$frontend['contents']['about_column4_content']}}</p>
              </li>
            </ul>
          </div>
        </div>
      
      </div>
      
      <div class="r-row full-width gray page-padding-top-section">
        <div class="r-row">
          <h2 class="box-header">OUR SERVICES</h2>
          <p class="description align-center">With over 15 years experience and real focus on customer satisfaction, you can rely on us for your next renovation,<br>driveway sett or home repair. We provide a professional service for private and commercial customers.</p>
          <ul class="services-list clearfix page-margin-top">
            <li>
              <a href="{{url($frontend['contents']['service_column1_link'])}}">
                <img src="{{url('assets/images/frontend/'.$frontend['contents']['service_column1_image'])}}" alt="">
              </a>
              <h4 class="box-header"><a href="{{url($frontend['contents']['service_column1_link'])}}">{{$frontend['contents']['service_column1_title']}}</a></h4>
              <p>{{$frontend['contents']['service_column1_content']}}</p>
            </li>
            <li>
              <a href="{{url($frontend['contents']['service_column2_link'])}}">
                <img src="{{url('assets/images/frontend/'.$frontend['contents']['service_column2_image'])}}" alt="">
              </a>
              <h4 class="box-header"><a href="{{url($frontend['contents']['service_column2_link'])}}">{{$frontend['contents']['service_column2_title']}}</a></h4>
              <p>{{$frontend['contents']['service_column2_content']}}</p>
            </li>
            <li>
              <a href="{{url($frontend['contents']['service_column3_link'])}}">
                <img src="{{url('assets/images/frontend/'.$frontend['contents']['service_column3_image'])}}" alt="">
              </a>
              <h4 class="box-header"><a href="{{url($frontend['contents']['service_column3_link'])}}">{{$frontend['contents']['service_column3_title']}}</a></h4>
              <p>{{$frontend['contents']['service_column3_content']}}</p>
            </li>
          </ul>
          <div class="align-center margin-top-67 padding-bottom-87">
            <a class="more" href="services.html" title="VIEW ALL SERVICES">VIEW ALL SERVICES</a>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection