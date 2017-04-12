@extends('frontend.template')

@section('content')
<!-- Slider Revolution -->
<div class="revolution-slider-container">
  <div class="revolution-slider">
    <ul style="display: none;">
      @foreach($frontend["banners"] as $banner)
        <li data-transition="fade" data-masterspeed="500" data-slotamount="1" data-delay="6000">
          <img src="{{asset('images/frontend/'.$banner->image)}}" alt="slidebg1" data-bgfit="cover">

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
      </li>
    </ul>
  </div>
</div>
<!--/-->

<div class="theme-page">
  <div class="clearfix">
    <div class="row page-margin-top-section">
      <div class="column column-1-4">
        <ul class="features-list big">
          <li class="sl-large-house-1">
            <div class="ornament"></div>
            <h4 class="box-header page-margin-top">WE'RE EXPERTS</h4>
            <p>Morbi nulla tortor, dignissim est node cursus euismod est arcu. Nomad at vehicula novum justo magna.</p>
          </li>
        </ul>
      </div>
      <div class="column column-1-4">
        <ul class="features-list big">
          <li class="sl-large-team">
            <div class="ornament"></div>
            <h4 class="box-header page-margin-top">WE'RE FRIENDLY</h4>
            <p>Morbi nulla tortor, dignissim est node cursus euismod est arcu. Nomad at vehicula novum justo magna.</p>
          </li>
        </ul>
      </div>
      <div class="column column-1-4">
        <ul class="features-list big">
          <li class="sl-large-measure">
            <div class="ornament"></div>
            <h4 class="box-header page-margin-top">WE'RE ACCURATE</h4>
            <p>Morbi nulla tortor, dignissim est node cursus euismod est arcu. Nomad at vehicula novum justo magna.</p>
          </li>
        </ul>
      </div>
      <div class="column column-1-4">
        <ul class="features-list big">
          <li class="sl-large-brush-2">
            <div class="ornament"></div>
            <h4 class="box-header page-margin-top">WE'RE TRUSTED</h4>
            <p>Morbi nulla tortor, dignissim est node cursus euismod est arcu. Nomad at vehicula novum justo magna.</p>
          </li>
        </ul>
      </div>
    </div>
    <div class="row full-width gray flex-box page-margin-top-section">
      <div class="column column-1-3 padding-left-right-100 padding-bottom-50">
        <h3 class="box-header page-margin-top-section">WHAT WE DO</h3>
        <p class="description t1 margin-top-34">Founded by Kevin Smith back in 2000, Renovate has established itself as one of the greatest<br>
          providers of construction services.</p>
        <ul class="list margin-top-26">
          <li class="template-bullet"><span>Quality Workmanship and Superior Knowledge</span></li>
          <li class="template-bullet"><span>A Job is Done on Time and on Budget</span></li>
          <li class="template-bullet"><span>Proven Results for Setting Exceptional Standards</span></li>
          <li class="template-bullet"><span>Professional Service for Private and Commercial</span></li>
        </ul>
        <div class="page-margin-top padding-bottom-17">
          <a class="more" href="services.html" title="OUR SERVICES">OUR SERVICES</a>
        </div>
      </div>
      <div class="column column-1-3 background-1">
        <img class="flex-hide" src="{{asset('renovate')}}/images/samples/750x500/image_07.jpg" alt="">
      </div>
      <div class="column column-1-3 padding-left-right-100 padding-bottom-50">
        <h3 class="box-header page-margin-top-section">OUR SKILLS</h3>
        <p class="description t1 margin-top-34">Founded by Kevin Smith back in 2000, Renovate has established itself as one of the greatest<br>
          providers of construction services.</p>
        <div class="progress-bar margin-top-34">
          <div class="single-bar">
            <small class="bar-label">Interior Renovation <span class="bar-label-units">95%</span></small>
            <span data-percentage-value="95" class="bar animated-element"></span>
          </div>
          <div class="single-bar">
            <small class="bar-label">Paver Walkways <span class="bar-label-units">72%</span></small>
            <span data-percentage-value="72" class="bar animated-element"></span>
          </div>
          <div class="single-bar">
            <small class="bar-label">Tiling and Painting <span class="bar-label-units">60%</span></small>
            <span data-percentage-value="60" class="bar animated-element"></span>
          </div>
        </div>
      </div>
    </div>
    <div class="row page-margin-top-section">
      <div class="row">
        <h2 class="box-header">RECENT NEWS</h2>
        <p class="description align-center">Founded by Kevin Smith back in 2000, Renovate has established itself as one of the greatest and prestigous<br> providers of construction focused interior renovation services and building.</p>
      </div>
      <div class="carousel-container page-margin-top clearfix">
        <ul class="blog horizontal-carousel three-columns autoplay-0 pause_on_hover-1">
          <li class="column column-1-3">
            <a href="post.html" title="What a Difference a Few Months Make" class="post-image">
              <img src="{{asset('renovate')}}/images/samples/750x500/image_10.jpg" alt="">
            </a>
            <ul class="post-details">
              <li class="date template-calendar">Apr<h2>25</h2>2015</li>
              <li class="template-eye">2 325</li>
              <li class="template-bubble"><a href="post.html#comments-list" title="5 comments">5</a></li>
            </ul>
            <h4><a href="post.html">WHAT A DIFFERENCE A FEW MONTHS MAKE</a></h4>
            <p class="description t1">Paetos dignissim at cursus elefeind norma arcu. Pellentesque mode accumsan est in tempus, etos at ullamcorper quam suscipit lacus maecenas tortor.</p>
          </li>
          <li class="column column-1-3">
            <a href="post.html" title="Kitchen And Living Room Renovation" class="post-image">
              <img src="{{asset('renovate')}}/images/samples/750x500/image_07.jpg" alt="">
            </a>
            <ul class="post-details">
              <li class="date template-calendar">Apr<h2>17</h2>2015</li>
              <li class="template-eye">2 125</li>
              <li class="template-bubble"><a href="post.html#comments-list" title="5 comments">5</a></li>
            </ul>
            <h4><a href="post.html">KITCHEN AND LIVING ROOM RENOVATION</a></h4>
            <p class="description t1">Paetos dignissim at cursus elefeind norma arcu. Pellentesque mode accumsan est in tempus, etos at ullamcorper quam suscipit lacus maecenas tortor.</p>
          </li>
          <li class="column column-1-3">
            <a href="post.html" title="Signs You Need Drain Repair Services" class="post-image">
              <img src="{{asset('renovate')}}/images/samples/750x500/image_05.jpg" alt="">
            </a>
            <ul class="post-details">
              <li class="date template-calendar">Apr<h2>17</h2>2015</li>
              <li class="template-eye">2 125</li>
              <li class="template-bubble"><a href="post.html#comments-list" title="5 comments">5</a></li>
            </ul>
            <h4><a href="post.html">SIGNS YOU NEED DRAIN REPAIR SERVICES</a></h4>
            <p class="description t1">Paetos dignissim at cursus elefeind norma arcu. Pellentesque mode accumsan est in tempus, etos at ullamcorper quam suscipit lacus maecenas tortor.</p>
          </li>
          <li class="column column-1-3">
            <a href="post.html" title="Steps To Improve Joint Placement" class="post-image">
              <img src="{{asset('renovate')}}/images/samples/750x500/image_09.jpg" alt="">
            </a>
            <ul class="post-details">
              <li class="date template-calendar">Apr<h2>17</h2>2015</li>
              <li class="template-eye">2 125</li>
              <li class="template-bubble"><a href="post.html#comments-list" title="5 comments">5</a></li>
            </ul>
            <h4><a href="post.html">STEPS TO IMPROVE JOINT PLACEMENT</a></h4>
            <p class="description t1">Paetos dignissim at cursus elefeind norma arcu. Pellentesque mode accumsan est in tempus, etos at ullamcorper quam suscipit lacus maecenas tortor.</p>
          </li>
          <li class="column column-1-3">
            <ul class="post-details">
              <li class="date template-calendar">Apr<h2>17</h2>2015</li>
              <li class="template-eye">2 125</li>
              <li class="template-bubble"><a href="post.html#comments-list" title="5 comments">5</a></li>
            </ul>
            <h4><a href="post.html">HOW TO CHOOSE A RELIABLE COMPANY</a></h4>
            <p class="description t1">Paetos dignissim at cursus elefeind norma arcu. Pellentesque mode accumsan est in tempus, etos at ullamcorper quam suscipit lacus maecenas tortor.</p>
          </li>
          <li class="column column-1-3">
            <a href="post.html" title="Installation Of Click Laminate Flooring" class="post-image">
              <img src="{{asset('renovate')}}/images/samples/750x500/image_01.jpg" alt="">
            </a>
            <ul class="post-details">
              <li class="date template-calendar">Apr<h2>17</h2>2015</li>
              <li class="template-eye">2 125</li>
              <li class="template-bubble"><a href="post.html#comments-list" title="5 comments">5</a></li>
            </ul>
            <h4><a href="post.html">INSTALLATION OF CLICK LAMINATE FLOORING</a></h4>
            <p class="description t1">Paetos dignissim at cursus elefeind norma arcu. Pellentesque mode accumsan est in tempus, etos at ullamcorper quam suscipit lacus maecenas tortor.</p>
          </li>
          <li class="column column-1-3">
            <a href="post.html" title="What a Difference a Few Months Make" class="post-image">
              <img src="{{asset('renovate')}}/images/samples/750x500/image_06.jpg" alt="">
            </a>
            <ul class="post-details">
              <li class="date template-calendar">Apr<h2>10</h2>2015</li>
              <li class="template-eye">2 325</li>
              <li class="template-bubble"><a href="post.html#comments-list" title="5 comments">5</a></li>
            </ul>
            <h4><a href="post.html">WHAT A DIFFERENCE A FEW MONTHS MAKE</a></h4>
            <p class="description t1">Paetos dignissim at cursus elefeind norma arcu. Pellentesque mode accumsan est in tempus, etos at ullamcorper quam suscipit lacus maecenas tortor.</p>
          </li>
          <li class="column column-1-3">
            <a href="post.html" title="Kitchen And Living Room Renovation" class="post-image">
              <img src="{{asset('renovate')}}/images/samples/750x500/image_03.jpg" alt="">
            </a>
            <ul class="post-details">
              <li class="date template-calendar">Apr<h2>10</h2>2015</li>
              <li class="template-eye">2 125</li>
              <li class="template-bubble"><a href="post.html#comments-list" title="5 comments">5</a></li>
            </ul>
            <h4><a href="post.html">KITCHEN AND LIVING ROOM RENOVATION</a></h4>
            <p class="description t1">Paetos dignissim at cursus elefeind norma arcu. Pellentesque mode accumsan est in tempus, etos at ullamcorper quam suscipit lacus maecenas tortor.</p>
          </li>
          <li class="column column-1-3">
            <a href="post.html" title="Signs You Need Drain Repair Services" class="post-image">
              <img src="{{asset('renovate')}}/images/samples/750x500/image_08.jpg" alt="">
            </a>
            <ul class="post-details">
              <li class="date template-calendar">Apr<h2>10</h2>2015</li>
              <li class="template-eye">2 125</li>
              <li class="template-bubble"><a href="post.html#comments-list" title="5 comments">5</a></li>
            </ul>
            <h4><a href="post.html">SIGNS YOU NEED DRAIN REPAIR SERVICES</a></h4>
            <p class="description t1">Paetos dignissim at cursus elefeind norma arcu. Pellentesque mode accumsan est in tempus, etos at ullamcorper quam suscipit lacus maecenas tortor.</p>
          </li>
        </ul>
        <div class="re-carousel-pagination"></div>
      </div>
      <div class="align-center padding-top-54 padding-bottom-17">
        <a class="more" href="blog_3_columns.html" title="VIEW ALL POSTS">VIEW ALL POSTS</a>
      </div>
    </div>
    <div class="row full-width gray page-padding-top-section page-margin-top-section">
      <div class="row">
        <h2 class="box-header">OUR SERVICES</h2>
        <p class="description align-center">With over 15 years experience and real focus on customer satisfaction, you can rely on us for your next renovation,<br>driveway sett or home repair. We provide a professional service for private and commercial customers.</p>
        <ul class="services-list services-icons row clearfix page-margin-top">
          <li>
            <a href="service_design_build.html" title="Design and Build">
              <span class="service-icon sl-small-house-2"></span>
            </a>
            <div class="service-content">
              <h4 class="box-header"><a href="service_design_build.html" title="Design and Build">DESIGN AND BUILD</a></h4>
              <p>From initial design and project specification to archieving a high end finish.</p>
            </div>
          </li>
          <li>
            <a href="service_household_repairs.html" title="Household Repairs">
              <span class="service-icon sl-small-wrench"></span>
            </a>
            <div class="service-content">
              <h4 class="box-header"><a href="service_household_repairs.html" title="Household Repairs">HOUSEHOLD REPAIRS</a></h4>
              <p>We offer affordable and reliable repairs and improvements to the home.</p>
            </div>
          </li>
        </ul>
        <ul class="services-list services-icons row clearfix margin-top-30">
          <li>
            <a href="service_paver_walkways.html" title="Paver Walkways">
              <span class="service-icon sl-small-bricks"></span>
            </a>
            <div class="service-content">
              <h4 class="box-header"><a href="service_paver_walkways.html" title="Paver Walkways">PAVER WALKWAYS</a></h4>
              <p>Brick pavers define beauty, elegance and durability for driveways, patios and walkways.</p>
            </div>
          </li>
          <li>
            <a href="service_tiling_painting.html" title="Tiling and Painting"><span class="service-icon sl-small-bucket"></span></a>
            <div class="service-content">
              <h4 class="box-header"><a href="service_tiling_painting.html" title="Tiling and Painting">TILING AND PAINTING</a></h4>
              <p>We offer quality tiling and painting solutions for interior and exterior.</p>
            </div>
          </li>
        </ul>
        <div class="align-center margin-top-67 padding-bottom-87">
          <a class="more" href="services.html" title="VIEW ALL SERVICES">VIEW ALL SERVICES</a>
        </div>
      </div>
    </div>
    <div class="row page-margin-top-section">
      <div class="column column-1-2">
        <h3 class="box-header">TESTIMONIALS</h3>
        <div class="row testimonials-container type-small margin-top-40">
          <div class="re-carousel-pagination"></div>
          <ul class="testimonials-list autoplay-1 pause_on_hover-1">
            <li>
              <p>"We would like to thank Renovate Company for an outstanding effort on this
                recently completed project located in the Moscow. The project involved a very
                aggressive schedule and it was completed on time. We would certainly like to
                use their professional services again."</p>
              <div class="ornament sl-small-chat"></div>
              <div class="author-details-box">
                <div class="author">MITCHEL SMITH</div>
                <div class="author-details">INTERIOR RENOVATION</div>
              </div>
            </li>
            <li>
              <p>"We would like to thank Renovate Company for an outstanding effort on this
                recently completed project located in the Moscow. The project involved a very
                aggressive schedule and it was completed on time. We would certainly like to
                use their professional services again."</p>
              <div class="ornament sl-small-conversation"></div>
              <div class="author-details-box">
                <div class="author">DEBORA HILTON</div>
                <div class="author-details">PAVER WALKWAYS</div>
              </div>
            </li>
            <li>
              <p>"We would like to thank Renovate Company for an outstanding effort on this
                recently completed project located in the Moscow. The project involved a very
                aggressive schedule and it was completed on time. We would certainly like to
                use their professional services again."</p>
              <div class="ornament sl-small-person"></div>
              <div class="author-details-box">
                <div class="author">LIAN HOLDEN</div>
                <div class="author-details">SOLAR SYSTEMS</div>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <div class="column column-1-2">
        <h3 class="box-header">WE WORK WITH</h3>
        <div class="our-clients-list-container margin-top-40 type-list">
          <ul class="our-clients-list type-list">
            <li class="vertical-align">
              <div class="our-clients-item-container">
                <div class="vertical-align-cell">
                  <a target="_blank" href="http://quanticalabs.com">
                    <img src="{{asset('renovate')}}/images/logos/logo_01.png" alt="">
                  </a>
                </div>
              </div>
            </li>
            <li class="vertical-align">
              <div class="our-clients-item-container">
                <div class="vertical-align-cell">
                  <a target="_blank" href="http://quanticalabs.com">
                    <img src="{{asset('renovate')}}/images/logos/logo_02.png" alt="">
                  </a>
                </div>
              </div>
            </li>
            <li class="vertical-align">
              <div class="our-clients-item-container">
                <div class="vertical-align-cell">
                  <a target="_blank" href="http://quanticalabs.com">
                    <img src="{{asset('renovate')}}/images/logos/logo_04.png" alt="">
                  </a>
                </div>
              </div>
            </li>
            <li class="vertical-align">
              <div class="our-clients-item-container">
                <div class="vertical-align-cell">
                  <a target="_blank" href="http://quanticalabs.com">
                    <img src="{{asset('renovate')}}/images/logos/logo_03.png" alt="">
                  </a>
                </div>
              </div>
            </li>
            <li class="vertical-align">
              <div class="our-clients-item-container">
                <div class="vertical-align-cell">
                  <a target="_blank" href="http://quanticalabs.com">
                    <img src="{{asset('renovate')}}/images/logos/logo_05.png" alt="">
                  </a>
                </div>
              </div>
            </li>
            <li class="vertical-align">
              <div class="our-clients-item-container">
                <div class="vertical-align-cell">
                  <a target="_blank" href="http://quanticalabs.com">
                    <img src="{{asset('renovate')}}/images/logos/logo_06.png" alt="">
                  </a>
                </div>
              </div>
            </li>
          </ul>
          <div class="re-carousel-pagination"></div>
        </div>
      </div>
    </div>
    <div class="row full-width gray page-padding-top-section page-margin-top-section padding-bottom-70">
      <div class="row">
        <h2 class="box-header">MEET OUR TEAM</h2>
        <p class="description align-center">We provide a professional renovation and installation services with a real focus on customer satisfaction.<br> Our installations are carried out by fully trained staff to the highest professional standards.</p>
        <ul class="team-list page-margin-top clearfix">
          <li class="team-box">
            <a href="team_mark_whilberg.html" title="Mark Whilberg">
              <img alt="Mark Whilberg" src="{{asset('renovate')}}/images/samples/390x260/team_01.png">
            </a>
            <div class="team-content">
              <h4 class="box-header">
                <a href="team_mark_whilberg.html" title="Mark Whilberg">MARK WHILBERG</a>
                <span>CO-FOUNDER</span>
              </h4>
              <p>Primus elite lectus tical at node. Porta commodo terminal forks sande. Nulla novum at novelle.</p>
            </div>
            <ul class="social-icons">
              <li><a title="" target="_blank" href="http://facebook.com/QuanticaLabs" class="social-facebook">&nbsp;</a></li>
              <li><a title="" target="_blank" href="http://twitter.com/quanticalabs" class="social-twitter">&nbsp;</a></li>
              <li><a title="" target="_blank" href="http://themeforest.net/user/QuanticaLabs/portfolio?ref=QuanticaLabs" class="social-linkedin">&nbsp;</a></li>
            </ul>
          </li>
          <li class="team-box">
            <a href="team_philip_brower.html" title="Philip Brower">
              <img alt="Philip Brower" src="{{asset('renovate')}}/images/samples/390x260/team_02.png">
            </a>
            <div class="team-content">
              <h4 class="box-header">
                <a href="team_philip_brower.html" title="Philip Brower">PHILIP BROWER</a>
                <span>CO-FOUNDER</span>
              </h4>
              <p>Primus elite lectus tical at node. Porta commodo terminal forks sande. Nulla novum at novelle.</p>
            </div>
            <ul class="social-icons">
              <li><a title="" target="_blank" href="http://facebook.com/QuanticaLabs" class="social-facebook">&nbsp;</a></li>
              <li><a title="" target="_blank" href="https://www.pinterest.com/quanticalabs/" class="social-pinterest">&nbsp;</a></li>
              <li><a title="" target="_blank" href="https://dribbble.com/QuanticaLabs" class="social-dribble">&nbsp;</a></li>
            </ul>
          </li>
          <li class="team-box">
            <a href="team_curtis_greene.html" title="Curtis Greene">
              <img alt="Curtis Greene" src="{{asset('renovate')}}/images/samples/390x260/team_03.png">
            </a>
            <div class="team-content">
              <h4 class="box-header">
                <a href="team_curtis_greene.html" title="Curtis Greene">CURTIS GREENE</a>
                <span>CT-OFFICER</span>
              </h4>
              <p>Primus elite lectus tical at node. Porta commodo terminal forks sande. Nulla novum at novelle.</p>
            </div>
            <ul class="social-icons">
              <li><a title="" target="_blank" href="https://www.youtube.com/user/quanticalabs" class="social-youtube">&nbsp;</a></li>
              <li><a title="" target="_blank" href="https://www.behance.net/quanticalabs" class="social-behance">&nbsp;</a></li>
              <li><a title="" target="_blank" href="http://facebook.com/QuanticaLabs" class="social-facebook">&nbsp;</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection