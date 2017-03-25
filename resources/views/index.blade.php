<?php use App\Models\Enums\TicketStat; ?>

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
          <div class="desc"> New Feedbacks </div>
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
          <div class="desc"> Total Profit </div>
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
          <div class="desc"> New Orders </div>
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
          <div class="desc"> Brand Popularity </div>
        </div>
      </a>
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
          <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 300px;"><div class="scroller" style="height: 300px; overflow: hidden; width: auto;" data-always-visible="1" data-rail-visible="0" data-initialized="1">
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
                              <button class="btn green btn-xs" onclick="location.href='{{url('ticket/save/'.$ticket->ticket_id)}}'">
                                {{ $action }}
                              </button>
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col2">
                      <div class="date"> {{ ViewHelper::timeAgo($ticket->updated_on) }} </div>
                    </div>
                  </li>
                @endforeach
              </ul>
            </div><div class="slimScrollBar" style="background: rgb(187, 187, 187); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; height: 186.335px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div></div>

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
          <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 300px;"><div class="scroller" style="height: 300px; overflow: hidden; width: auto;" data-always-visible="1" data-rail-visible="0" data-initialized="1">
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
                <td>{{ $assignment->ticket_code }}</td>
                <td>{{ $assignment->name }}</td>
                <td>{{ ViewHelper::formatTime($assignment->time_start) }} to {{ ViewHelper::formatTime($assignment->time_end) }}</td>
              </tr>
              </tbody>
              @endforeach


            </table>

            </div><div class="slimScrollBar" style="background: rgb(187, 187, 187); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; height: 186.335px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div></div>

        </div>
      </div>
    </div>

  </div>
@endsection