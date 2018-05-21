<?php use App\Models\Enums\TicketStat; ?>

@extends("admin.template")

@section('content')
  <h1 class="page-title">
    Dashboard
  </h1>
  
  <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
      <a class="dashboard-stat dashboard-stat-v2 blue" href="{{ url('admin/ticket?stat='.TicketStat::Opened) }}">
        <div class="visual">
          <i class="fa fa-comments"></i>
        </div>
        <div class="details">
          <div class="number">
            <span data-counter="counterup" data-value="{{ $new_ticket_count }}">{{ ViewHelper::formatNumber($new_ticket_count) }}</span>
          </div>
          <div class="desc"> Number of New Tickets </div>
        </div>
      </a>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
      <a class="dashboard-stat dashboard-stat-v2 red" href="{{ url('admin/ticket?stat='.TicketStat::Opened) }}">
        <div class="visual">
          <i class="fa fa-bar-chart-o"></i>
        </div>
        <div class="details">
          <div class="number">
            $<span data-counter="counterup" data-value="{{ $new_ticket_value }}">{{ ViewHelper::formatNumber($new_ticket_value) }}</span>
          </div>
          <div class="desc"> New Tickets Value </div>
        </div>
      </a>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
      <a class="dashboard-stat dashboard-stat-v2 green" href="{{ url('admin/ticket?stat='.TicketStat::Completed) }}">
        <div class="visual">
          <i class="fa fa-shopping-cart"></i>
        </div>
        <div class="details">
          <div class="number">
            $<span data-counter="counterup" data-value="{{ $completed_ticket_value }}">{{ ViewHelper::formatNumber($completed_ticket_value) }}</span>
          </div>
          <div class="desc"> Completed Tickets Value </div>
        </div>
      </a>
    </div>
  </div>
  
  <div class="row">
    <div class="col-lg-6 col-xs-12 col-sm-12">
      <div class="portlet light ">
        <div class="portlet-title">
          <div class="caption">
            <span class="caption-subject bold uppercase font-dark">Monthly Number of Completed Tickets</span>
          </div>
        </div>
        <div class="portlet-body">
          @if(count($completed_ticket_count_monthly))
            <div id="div-chart1"></div>
          @else
            <div class="alert alert-info">No records found</div>
          @endif
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-xs-12 col-sm-12">
      <div class="portlet light ">
        <div class="portlet-title">
          <div class="caption ">
            <span class="caption-subject font-dark bold uppercase">Monthly Completed Tickets Value</span>
          </div>
        </div>
        <div class="portlet-body">
          @if(count($completed_ticket_count_monthly))
            <div id="div-chart2"></div>
          @else
            <div class="alert alert-info">No records found</div>
          @endif
        </div>
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-lg-6 col-xs-12 col-sm-12">
      <div class="portlet light ">
        <div class="portlet-title">
          <div class="caption">
            <i class="icon-share font-dark hide"></i>
            <span class="caption-subject font-dark bold uppercase">Recent Tickets</span>
          </div>
        </div>
        
        <div class="portlet-body">
          <div class="scroller" style="height:200px" data-always-visible="1" data-rail-visible="1" data-rail-color="grey" data-handle-color="black">
            <ul class="feeds">
              @foreach($tickets as $ticket)
                <li>
                  <div class="col1">
                    <div class="cont">
                      <div class="cont-col1">
                        <div class="label label-sm label-info">
                          {{ TicketStat::$values[$ticket->stat] }}
                        </div>
                      </div>
                      <div class="cont-col2">
                        <div class="desc"> {{ $ticket->ticket_code }} - {{ $ticket->title   }}
                          <?php $action = "";
                          switch ($ticket->stat) {
                            case TicketStat::Drafted:
                              $action = "Open"; break;
                            case TicketStat::Opened:
                              $action = "Quote"; break;
                            case TicketStat::Accepted:
                              $action = "Complete"; break;
                            case TicketStat::Completed:
                              $action = "Pay"; break;
                          } ?>
                          @if($action)
                            <button class="btn green btn-xs" onclick="location.href='{{ ViewHelper::ticketLinkAdmin($ticket) }}'">
                              {{ $action }}
                            </button>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col2">
                    <div class="date"> {{ ViewHelper::timeAgo($ticket->requested_on) }} </div>
                  </div>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-xs-12 col-sm-12">
      <div class="portlet light ">
        <div class="portlet-title">
          <div class="caption">
            <i class="icon-share font-dark hide"></i>
            <span class="caption-subject font-dark bold uppercase">Today's Assignments</span>
          </div>
        </div>
        <div class="portlet-body">
          <div class="scroller" style="height:200px" data-always-visible="1" data-rail-visible="1" data-rail-color="grey" data-handle-color="black">
            <table class="table table-bordered">
              <thead>
              <tr>
                <th width="120px">Ticket</th>
                <th width="100px">Name</th>
                <th>Time</th>
              </tr>
              </thead>
              <tbody>
              @foreach($staff_assignments as $assignment)
                <tr>
                  <td><a href="{{url("admin/ticket/view/".$assignment->ticket_id)}}">{{ $assignment->ticket_code }}</a></td>
                  <td>{{ $assignment->name }}</td>
                  <td>{{ ViewHelper::formatTime($assignment->time_start) }} to {{ ViewHelper::formatTime($assignment->time_end) }}</td>
                </tr>
              </tbody>
              @endforeach
            
            
            </table>
          
          </div>
        </div>
      </div>
    </div>
  
  </div>
@endsection

@section('script')
  <script src="{{asset("assets/metronic/global/plugins/counterup/jquery.waypoints.min.js")}}" type="text/javascript"></script>
  <script src="{{asset("assets/metronic/global/plugins/counterup/jquery.counterup.min.js")}}" type="text/javascript"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  
  <script>
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawMultSeries);
    
    function drawMultSeries() {
        @if(count($completed_ticket_count_monthly))
      var r = {!! json_encode($completed_ticket_count_monthly) !!};
      
      var data = google.visualization.arrayToDataTable([
        ['Date', 'Count'],
        {!! json_encode($completed_ticket_count_monthly) !!}
      ]);
      
      var options = { legend: {position: 'none'} };
      var chart = new google.visualization.ColumnChart(document.getElementById('div-chart1'));
      chart.draw(data, options);
        @endif
        
        @if(count($completed_ticket_count_monthly))
      var data = google.visualization.arrayToDataTable([
          ['Date', 'Value'],
          {!! json_encode($completed_ticket_value_monthly) !!}
        ]);
      
      var chart = new google.visualization.ColumnChart(document.getElementById('div-chart2'));
      chart.draw(data, options);
      @endif
    }
  </script>
@endsection