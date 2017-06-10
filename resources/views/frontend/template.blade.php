<!DOCTYPE html>
<html>
<head>
  <title>{{ config('app.name') }}</title>
  <!--meta-->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.2" />
  <meta name="format-detection" content="telephone=no" />
  <meta name="keywords" content="Construction, Renovation" />
  <meta name="description" content="Responsive Construction Renovation Template" />
  
  <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
  <link href='//fonts.googleapis.com/css?family=Raleway:100,300,400,500,600,700,900' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="{{asset('assets/renovate/style/reset.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/renovate/rs-plugin/css/settings.css')}}" media="screen" />
  <link rel="stylesheet" type="text/css" href="{{asset('assets/renovate/style/superfish.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/renovate/style/prettyPhoto.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/renovate/style/jquery.qtip.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/renovate/style/style.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/renovate/style/animations.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/renovate/style/responsive.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/renovate/style/odometer-theme-default.css')}}">
  <!--fonts-->
  <link rel="stylesheet" type="text/css" href="{{asset('assets/renovate/fonts/streamline-small/styles.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/renovate/fonts/streamline-large/styles.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/renovate/fonts/template/styles.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/renovate/fonts/social/styles.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/jquery-ui.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/renovate/style/custom.css')}}">

  <link href="{{asset('assets/metronic/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />

  <link rel="shortcut icon" href="{{asset('assets/renovate/images/favicon.ico')}}">
</head>
<body>
<div class="site-container">
  <div class="header-top-bar-container clearfix">
    <div class="header-top-bar">
      <ul class="contact-details clearfix">
        <li class="template-phone">
          <a href="tel:+149752322235">{{$frontend['contents']['contact']}}</a>
        </li>
        <li class="template-mail">
          <a href="mailto:renovate@mail.com">{{$frontend['contents']['email']}}</a>
        </li>
        <li class="template-clock">
          {{$frontend['contents']['opening_hours']}}
        </li>
      </ul>
      <ul class="social-icons">
        <li>
          <a target="_blank" href="{{$frontend['contents']['facebook']}}" class="social-facebook" title="facebook"></a>
        </li>
      </ul>
    </div>
    <a href="#" class="header-toggle template-arrow-up"></a>
  </div>
  <div class="header-container">
    <!--<div class="header-container sticky">-->
    <div class="vertical-align-table column-1-1">
      <div class="header clearfix">
        <div class="logo vertical-align-cell">
          <a href="{{url('')}}"><img src="{{asset('assets/images/mr-wright-logo.png')}} " style="max-height: 30px"></a>
          {{--<h1>MR WRIGHT</h1>--}}
        </div>
        <a href="#" class="mobile-menu-switch vertical-align-cell">
          <span class="line"></span>
          <span class="line"></span>
          <span class="line"></span>
        </a>
        <div class="menu-container clearfix vertical-align-cell">
          <nav>
            <ul class="sf-menu">
            @if(isset($frontend['logged_in_requester']))
                <li class="selected">
                  <a href="{{ url('/') }}" title="Services">
                    HOME
                  </a>
                  <ul>
                    <li>
                      <a href="{{ url('about') }}">
                        ABOUT
                      </a>
                    </li>
                    <li>
                      <a href="{{ url('services') }}">
                        SERVICES
                      </a>
                    </li>
                    <li>
                      <a href="{{ url('contact') }}">
                        CONTACT
                      </a>
                    </li>
                  </ul>
                </li>
                <li>
                  <a href="{{ url('account') }}" title="Account">
                    ACCOUNT ({{Auth::user()->username}})
                  </a>
                </li>
                @if($frontend['logged_in_requester']->admin)
                  <li>
                    <a href="{{ url('members') }}" title="Invite">
                      MEMBERS
                    </a>
                  </li>
                @endif
                <li>
                  <a href="{{ url('ticket') }}" title="Tickets">
                    TICKETS
                  </a>
                </li>
                <li>
                  <a href="{{ url('logout') }}" title="Log Out">
                    LOG OUT
                  </a>
                </li>
              @else
                <li class="selected">
                  <a href="{{ url('/') }}" title="Home">
                    HOME
                  </a>
                </li>
                <li>
                  <a href="{{url('about')}}" title="About">
                    ABOUT
                  </a>
                </li>
                <li>
                  <a href="{{ url('services') }}" title="Services">
                    SERVICES
                  </a>
                  <ul>
                    @foreach($frontend['services'] as $service)
                      <li>
                        <a href="{{ url('services/'.$service->slug) }}" title="{{$service->title}}">
                          {{$service->title}}
                        </a>
                      </li>
                    @endforeach
                  </ul>
                </li>
                <li>
                  <a href="{{url('membership')}}" title="About">
                    MEMBERSHIP
                  </a>
                </li>
                <li>
                  <a href="{{url('rewards')}}" title="Rewards">
                    REWARDS
                  </a>
                </li>
                <li>
                  <a href="{{url('login')}}" title="Login">
                    LOGIN
                  </a>
                </li>
                <li class="left-flyout">
                  <a href="{{url('contact')}}" title="Contact">
                    CONTACT
                  </a>
                </li>
              @endif
            </ul>
          </nav>
          <div class="mobile-menu-container">
            <div class="mobile-menu-divider"></div>
            <nav>
              <ul class="mobile-menu collapsible-mobile-submenus">
                @if(Auth::check() && Auth::user()->type == \App\Models\Enums\UserType::Requester)
                  <li class="selected">
                    <a href="{{ url('/') }}" title="Services">
                      HOME
                    </a>
                    <ul>
                      <li>
                        <a href="{{ url('about') }}">
                          ABOUT
                        </a>
                      </li>
                      <li>
                        <a href="{{ url('services') }}">
                          SERVICES
                        </a>
                      </li>
                      <li>
                        <a href="{{ url('contact') }}">
                          CONTACT
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li>
                    <a href="{{ url('account') }}" title="Account">
                      ACCOUNT ({{Auth::user()->username}})
                    </a>
                  </li>
                  <li>
                    <a href="{{ url('members') }}" title="Invite">
                      MEMBERS
                    </a>
                  </li>
                  <li>
                    <a href="{{ url('ticket') }}" title="Tickets">
                      TICKETS
                    </a>
                  </li>
                  <li>
                    <a href="{{ url('logout') }}" title="Log Out">
                      LOG OUT
                    </a>
                  </li>
                @else
                  <li class="selected">
                    <a href="{{ url('/') }}" title="Home">
                      HOME
                    </a>
                  </li>
                  <li>
                    <a href="{{url('about')}}" title="About">
                      ABOUT
                    </a>
                  </li>
                  <li>
                    <a href="{{ url('services') }}" title="Services">
                      SERVICES
                    </a>
                    <ul>
                      @foreach($frontend['services'] as $service)
                        <li>
                          <a href="{{ url('services/'.$service->slug) }}" title="{{$service->title}}">
                            {{$service->title}}
                          </a>
                        </li>
                      @endforeach
                    </ul>
                  </li>
                  <li>
                    <a href="{{url('membership')}}" title="About">
                      MEMBERSHIP
                    </a>
                  </li>
                  <li>
                    <a href="{{url('register')}}" title="Register">
                      REGISTER
                    </a>
                  </li>
                  <li>
                    <a href="{{url('login')}}" title="Login">
                      LOGIN
                    </a>
                  </li>
                  <li class="left-flyout">
                    <a href="{{url('contact')}}" title="Contact">
                      CONTACT
                    </a>
                  </li>
                @endif
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  @if(isset($title))
    <div class="r-row gray full-width page-header vertical-align-table">
      <div class="r-row full-width padding-top-bottom-50 vertical-align-cell">
        <div class="r-row">
          <div class="page-header-left">
            <h1>{{ strtoupper($title) }}</h1>
          </div>
        </div>
      </div>
    </div>
  @endif
  
  @if(isset($title))
    <div class="r-row page-margin-top margin-bottom-40">

      @if (isset($errors) && $errors->any())
        <div class="alert alert-danger">
          @foreach ($errors->all() as $error)
            {{$error}}<br>
          @endforeach
        </div>
      @endif

      @if(Session::has('msg'))
        <div class="alert alert-success">
          {!! Session::get('msg') !!}
        </div>
      @endif
      
      @yield('content')
    </div>
  @else
    @yield('content')
  
  @endif
  
  <div class="r-row yellow full-width padding-top-bottom-30">
    <div class="r-row">
      <div class="column column-1-3">
        <ul class="contact-details-list">
          <li class="sl-small-phone">
            <p>Phone:<br>
              {{$frontend['contents']['contact']}}
            </p>
          </li>
        </ul>
      </div>
      <div class="column column-1-3">
        <ul class="contact-details-list">
          <li class="sl-small-location">
            <p>{!! nl2br($frontend['contents']['address']) !!}
            </p>
          </li>
        </ul>
      </div>
      <div class="column column-1-3">
        <ul class="contact-details-list">
          <li class="sl-small-mail">
            <p>E-mail:<br>
              <a href="mailto:{{$frontend['contents']['email']}}">{{$frontend['contents']['email']}}</a></p>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="r-row align-center padding-top-bottom-30">
    <span class="copyright">© Copyright {{ date('Y') }} <a href="{{ url('/') }}">{{ config('app.name') }}</a></span>
  </div>
</div>
<a href="#top" class="scroll-top animated-element template-arrow-up" title="Scroll to top"></a>
<!--js-->
<script type="text/javascript" src="{{asset('assets/renovate/js/jquery-1.12.4.min.js')}}"></script>
<script src="{{asset('assets/js/jquery-ui.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('assets/renovate/js/jquery-migrate-1.4.1.min.js')}}"></script>
<!--slider revolution-->
<script type="text/javascript" src="{{asset('assets/renovate/rs-plugin/js/jquery.themepunch.tools.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/renovate/rs-plugin/js/jquery.themepunch.revolution.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/renovate/js/jquery.ba-bbq.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/renovate/js/jquery-ui-1.11.4.custom.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/renovate/js/jquery.ui.touch-punch.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/renovate/js/jquery.isotope.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/renovate/js/jquery.easing.1.3.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/renovate/js/jquery.carouFredSel-6.2.1-packed.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/renovate/js/jquery.touchSwipe.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/renovate/js/jquery.transit.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/renovate/js/jquery.hint.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/renovate/js/jquery.costCalculator.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/renovate/js/jquery.parallax.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/renovate/js/jquery.prettyPhoto.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/renovate/js/jquery.qtip.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/renovate/js/jquery.blockUI.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/renovate/js/main.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/renovate/js/odometer.min.js')}}"></script>

<script src="{{asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/metronic/global/plugins/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/vue.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/axios.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/common.js')}}" type="text/javascript"></script>

<script>
  $(document).ready(function() {
    initDatepicker();
  });


  function initDatepicker() {
    $(".datepicker").datepicker({
      dateFormat: "dd M yy"
    });
  }

</script>


@section('script')

@show

</body>
</html>