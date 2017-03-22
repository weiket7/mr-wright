@extends("template")

@section('content')
  <h1 class="page-title">
    Dashboard
  </h1>

  <div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
        <div class="visual">
          <i class="fa fa-comments"></i>
        </div>
        <div class="details">
          <div class="number">
            <span data-counter="counterup" data-value="1349">1349</span>
          </div>
          <div class="desc"> Open Tickets </div>
        </div>
      </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <a class="dashboard-stat dashboard-stat-v2 red" href="#">
        <div class="visual">
          <i class="fa fa-bar-chart-o"></i>
        </div>
        <div class="details">
          <div class="number">
            <span data-counter="counterup" data-value="12,5">12,5</span>M$ </div>
          <div class="desc"> Completed Tickets </div>
        </div>
      </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <a class="dashboard-stat dashboard-stat-v2 green" href="#">
        <div class="visual">
          <i class="fa fa-shopping-cart"></i>
        </div>
        <div class="details">
          <div class="number">
            <span data-counter="counterup" data-value="549">549</span>
          </div>
          <div class="desc"> Invoiced Tickets </div>
        </div>
      </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
        <div class="visual">
          <i class="fa fa-globe"></i>
        </div>
        <div class="details">
          <div class="number"> +
            <span data-counter="counterup" data-value="89">89</span>% </div>
          <div class="desc"> Paid Tickets </div>
        </div>
      </a>
    </div>
  </div>
@endsection