<!DOCTYPE html>
<html>
<head>
  <title>Renovate - Construction Renovation Template</title>
  <!--meta-->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.2" />
  <meta name="format-detection" content="telephone=no" />
  <meta name="keywords" content="Construction, Renovation" />
  <meta name="description" content="Responsive Construction Renovation Template" />

  <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
  <link href='//fonts.googleapis.com/css?family=Raleway:100,300,400,500,600,700,900' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="{{asset('renovate/style/reset.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('renovate/rs-plugin/css/settings.css')}}" media="screen" />
  <link rel="stylesheet" type="text/css" href="{{asset('renovate/style/superfish.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('renovate/style/prettyPhoto.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('renovate/style/jquery.qtip.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('renovate/style/style.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('renovate/style/animations.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('renovate/style/responsive.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('renovate/style/odometer-theme-default.css')}}">
  <!--fonts-->
  <link rel="stylesheet" type="text/css" href="{{asset('renovate/fonts/streamline-small/styles.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('renovate/fonts/streamline-large/styles.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('renovate/fonts/template/styles.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('renovate/fonts/social/styles.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('renovate/style/custom.css')}}">
  <link rel="shortcut icon" href="{{asset('renovate/images/favicon.ico')}}">
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
      <div class="search-container">
        <a class="template-search" href="#" title="Search"></a>
        <form class="search" action="search.html">
          <input type="text" name="s" placeholder="Search..." value="Search..." class="search-input hint">
          <fieldset class="search-submit-container">
            <span class="template-search"></span>
            <input type="submit" class="search-submit" value="">
          </fieldset>
        </form>
      </div>
      <ul class="social-icons">
        <li>
          <a target="_blank" href="http://facebook.com/QuanticaLabs" class="social-facebook" title="facebook"></a>
        </li>
        <li>
          <a target="_blank" href="https://twitter.com/QuanticaLabs" class="social-twitter" title="twitter"></a>
        </li>
        <li>
          <a href="https://pinterest.com/quanticalabs/" class="social-pinterest" title="pinterest"></a>
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
          <h1>MR WRIGHT</h1>
        </div>
        <a href="#" class="mobile-menu-switch vertical-align-cell">
          <span class="line"></span>
          <span class="line"></span>
          <span class="line"></span>
        </a>
        <div class="menu-container clearfix vertical-align-cell">
          <nav>
            <ul class="sf-menu">
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
              {{--<li>
                <a href="projects.html" title="Projects">
                  PROJECTS
                </a>
              </li>--}}
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
            </ul>
          </nav>
          <div class="mobile-menu-container">
            <div class="mobile-menu-divider"></div>
            <nav>
              <ul class="mobile-menu collapsible-mobile-submenus">
                <li class="selected">
                  <a href="index.html" title="Home">
                    HOME
                  </a>
                  <a href="#" class="template-arrow-menu"></a>
                  <ul>
                    <li>
                      <a href="index.html" title="Home Style 1">
                        Home Style 1
                      </a>
                    </li>
                    <li class="selected">
                      <a href="home2.html" title="Home Style 2">
                        Home Style 2
                      </a>
                    </li>
                  </ul>
                </li>
                <li>
                  <a href="services.html" title="Services">
                    SERVICES
                  </a>
                  <a href="#" class="template-arrow-menu"></a>
                  <ul>
                    <li>
                      <a href="service_interior_renovation.html" title="Interior Renovation">
                        Interior Renovation
                      </a>
                    </li>
                    <li>
                      <a href="service_design_build.html" title="Design and Build">
                        Design and Build
                      </a>
                    </li>
                    <li>
                      <a href="service_tiling_painting.html" title="Design and Build">
                        Tiling and Painting
                      </a>
                    </li>
                    <li>
                      <a href="service_paver_walkways.html" title="Paver Walkways">
                        Paver Walkways
                      </a>
                    </li>
                    <li>
                      <a href="service_household_repairs.html" title="Household Repairs">
                        Household Repairs
                      </a>
                    </li>
                    <li>
                      <a href="service_solar_systems.html" title="Solar Systems">
                        Solar Systems
                      </a>
                    </li>
                  </ul>
                </li>
                <li>
                  <a href="projects.html" title="Projects">
                    PROJECTS
                  </a>
                  <a href="#" class="template-arrow-menu"></a>
                  <ul>
                    <li>
                      <a href="project_interior_renovation.html" title="Interior Renovation">
                        Interior Renovation
                      </a>
                    </li>
                    <li>
                      <a href="project_garden_renovation.html" title="Garden Renovation">
                        Garden Renovation
                      </a>
                    </li>
                    <li>
                      <a href="project_painting.html" title="Painting">
                        Painting
                      </a>
                    </li>
                    <li>
                      <a href="project_design_build.html" title="Design and Build">
                        Design and Build
                      </a>
                    </li>
                    <li>
                      <a href="project_solar_systems.html" title="Solar Systems">
                        Solar Systems
                      </a>
                    </li>
                  </ul>
                </li>
                <li>
                  <a href="team.html" title="Our Team">
                    OUR TEAM
                  </a>
                </li>
                <li>
                  <a href="about.html" title="Pages">
                    PAGES
                  </a>
                  <a href="#" class="template-arrow-menu"></a>
                  <ul>
                    <li>
                      <a href="about.html" title="About">
                        About
                      </a>
                    </li>
                    <li>
                      <a href="404.html" title="404 Not Found">
                        404 Not Found
                      </a>
                    </li>
                    <li>
                      <a href="services.html" title="Services Style 1">
                        Services Style 1
                      </a>
                    </li>
                    <li>
                      <a href="services2.html" title="Services Style 2">
                        Services Style 2
                      </a>
                    </li>
                    <li>
                      <a href="service_interior_renovation.html" title="Single Service">
                        Single Service
                      </a>
                    </li>
                    <li>
                      <a href="projects.html" title="Projects">
                        Projects
                      </a>
                    </li>
                    <li>
                      <a href="project_interior_renovation.html" title="Single Project">
                        Single Project
                      </a>
                    </li>
                    <li>
                      <a href="team.html" title="Team">
                        Team
                      </a>
                    </li>
                    <li>
                      <a href="team_mark_whilberg.html" title="Single Team">
                        Single Team
                      </a>
                    </li>
                  </ul>
                </li>
                <li>
                  <a href="blog.html" title="Blog">
                    BLOG
                  </a>
                  <a href="#" class="template-arrow-menu"></a>
                  <ul>
                    <li>
                      <a href="blog.html" title="Blog">
                        Blog
                      </a>
                    </li>
                    <li>
                      <a href="blog_left_sidebar.html" title="Blog">
                        Blog Left Sidebar
                      </a>
                    </li>
                    <li>
                      <a href="blog_2_columns.html" title="Blog 2 Columns">
                        Blog 2 Columns
                      </a>
                    </li>
                    <li>
                      <a href="blog_3_columns.html" title="Blog 3 Columns">
                        Blog 3 Columns
                      </a>
                    </li>
                    <li>
                      <a href="post.html" title="Single Post">
                        Single Post
                      </a>
                    </li>
                    <li>
                      <a href="search.html?s=ipsum" title="Search Template">
                        Search Template
                      </a>
                    </li>
                  </ul>
                </li>
                <li>
                  <a href="cost_calculator.html" title="Authors">
                    COST CALCULATOR
                  </a>
                </li>
                <li class="left-flyout">
                  <a href="contact.html" title="Contact">
                    CONTACT
                  </a>
                  <a href="#" class="template-arrow-menu"></a>
                  <ul>
                    <li>
                      <a href="contact.html" title="Contact Style 1">
                        Contact Style 1
                      </a>
                    </li>
                    <li>
                      <a href="contact_2.html" title="Contact Style 2">
                        Contact Style 2
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>

  @yield('content')

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
  <div class="r-row gray full-width page-padding-top padding-bottom-50">
    <div class="r-row row-4-4">
      <div class="column column-1-4">
        <h6 class="box-header">About Us</h6>
        <p class="description t1">{{$frontend['contents']['footer_about']}}</p>
        <ul class="social-icons yellow margin-top-26">
          <li>
            <a target="_blank" href="http://facebook.com/QuanticaLabs" class="social-facebook" title="facebook"></a>
          </li>
          <li>
            <a target="_blank" href="https://twitter.com/QuanticaLabs" class="social-twitter" title="twitter"></a>
          </li>
          <li>
            <a target="_blank" href="http://themeforest.net/user/QuanticaLabs/portfolio?ref=QuanticaLabs" class="social-linkedin" title="linkedin"></a>
          </li>
          <li>
            <a href="https://pinterest.com/quanticalabs/" class="social-pinterest" title="pinterest"></a>
          </li>
        </ul>
      </div>
      <div class="column column-1-4">
        <h6 class="box-header">Our Services</h6>
        <ul class="list margin-top-20">
          @foreach($frontend['services'] as $service)
            <li class="template-bullet">{{ $service->title }}</li>
          @endforeach
        </ul>
      </div>
      <div class="column column-1-4">
        <h6 class="box-header">Categories</h6>
        <ul class="taxonomies margin-top-30">
          <li><a href="category.html" title="BUILD">BUILD</a></li>
          <li><a href="category.html" title="DESIGN">DESIGN</a></li>
          <li><a href="category.html" title="FLOORING">FLOORING</a></li>
          <li><a href="category.html" title="PAINTING">PAINTING</a></li>
          <li><a href="category.html" title="PAVERS">PAVERS</a></li>
          <li><a href="category.html" title="PLUMBING">PLUMBING</a></li>
          <li><a href="category.html" title="RENOVATION">RENOVATION</a></li>
          <li><a href="category.html" title="REPAIRS">REPAIRS</a></li>
          <li><a href="category.html" title="SOLAR SYSTEMS">SOLAR SYSTEMS</a></li>
          <li><a href="category.html" title="TILING">TILING</a></li>
        </ul>
      </div>
      <div class="column column-1-4">
        <h6 class="box-header">Latest Posts</h6>
        <ul class="blog small margin-top-30">
          <li>
            <a href="post.html" title="What a Difference a Few Months Make" class="post-image">
              <img src="{{asset('renovate')}}/images/samples/90x90/image_10.jpg" alt="">
            </a>
            <div class="post-content">
              <a href="post.html" title="What a Difference a Few Months Make">What a Difference a Few Months Make</a>
              <ul class="post-details">
                <li class="date">April 25, 2015</li>
              </ul>
            </div>
          </li>
          <li>
            <a href="post.html" title="Kitchen and Living Room Renovation" class="post-image">
              <img src="{{asset('renovate')}}/images/samples/90x90/image_07.jpg" alt="">
            </a>
            <div class="post-content">
              <a href="post.html" title="Kitchen and Living Room Renovation">Kitchen and Living Room Renovation</a>
              <ul class="post-details">
                <li class="date">April 17, 2015</li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="r-row align-center padding-top-bottom-30">
    <span class="copyright">© Copyright 2015 <a href="http://themeforest.net/item/renovate-construction-renovation-template/11313006?ref=QuanticaLabs" title="Renovate Template" target="_blank">Renovate Template</a> by <a href="http://quanticalabs.com" title="QuanticaLabs" target="_blank">QuanticaLabs</a></span>
  </div>
</div>
<a href="#top" class="scroll-top animated-element template-arrow-up" title="Scroll to top"></a>
<!--js-->
<script type="text/javascript" src="{{asset('renovate/js/jquery-1.12.4.min.js')}}"></script>
<script type="text/javascript" src="{{asset('renovate/js/jquery-migrate-1.4.1.min.js')}}"></script>
<!--slider revolution-->
<script type="text/javascript" src="{{asset('renovate/rs-plugin/js/jquery.themepunch.tools.min.js')}}"></script>
<script type="text/javascript" src="{{asset('renovate/rs-plugin/js/jquery.themepunch.revolution.min.js')}}"></script>
<script type="text/javascript" src="{{asset('renovate/js/jquery.ba-bbq.min.js')}}"></script>
<script type="text/javascript" src="{{asset('renovate/js/jquery-ui-1.11.4.custom.min.js')}}"></script>
<script type="text/javascript" src="{{asset('renovate/js/jquery.ui.touch-punch.min.js')}}"></script>
<script type="text/javascript" src="{{asset('renovate/js/jquery.isotope.min.js')}}"></script>
<script type="text/javascript" src="{{asset('renovate/js/jquery.easing.1.3.min.js')}}"></script>
<script type="text/javascript" src="{{asset('renovate/js/jquery.carouFredSel-6.2.1-packed.js')}}"></script>
<script type="text/javascript" src="{{asset('renovate/js/jquery.touchSwipe.min.js')}}"></script>
<script type="text/javascript" src="{{asset('renovate/js/jquery.transit.min.js')}}"></script>
<script type="text/javascript" src="{{asset('renovate/js/jquery.hint.min.js')}}"></script>
<script type="text/javascript" src="{{asset('renovate/js/jquery.costCalculator.min.js')}}"></script>
<script type="text/javascript" src="{{asset('renovate/js/jquery.parallax.min.js')}}"></script>
<script type="text/javascript" src="{{asset('renovate/js/jquery.prettyPhoto.js')}}"></script>
<script type="text/javascript" src="{{asset('renovate/js/jquery.qtip.min.js')}}"></script>
<script type="text/javascript" src="{{asset('renovate/js/jquery.blockUI.min.js')}}"></script>
<script type="text/javascript" src="{{asset('renovate/js/main.js')}}"></script>
<script type="text/javascript" src="{{asset('renovate/js/odometer.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
</body>
</html>