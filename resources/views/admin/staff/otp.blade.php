<?php use App\Models\Enums\TicketStat; ?>

@extends("admin.template")

@section('content')
  <div class="portlet light ">
    <div class="portlet-title">
      <div class="caption">
        <i class="icon-share font-dark hide"></i>
        <span class="caption-subject font-dark bold uppercase">Assigned Tickets</span>
      </div>
    </div>
    <div class="portlet-body form-horizontal">
      <form method="post" action="">
        {{ csrf_field() }}
          <div class="form-group">
            <label class="control-label col-md-2 ticket-md-2">Title</label>
            <div class="col-md-10 form-control-static ticket-md-10">
              {{ $ticket->title }}
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <div class="control-label col-xs-3">
                  Ticket Code
                </div>
                <div class="form-control-static col-xs-9">
                  {{ $ticket->ticket_code }}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <div class="control-label col-xs-3">
                  Status
                </div>
                <div class="form-control-static col-xs-9">
                  {{ TicketStat::$values[$ticket->stat] }}
                </div>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <div class="control-label col-xs-3">
                  Company
                </div>
                <div class="form-control-static col-xs-9">
                  {{ $ticket->company_name }}<br>
                  {{ $ticket->office_name }}<br>
                  {{ $ticket->office_addr }}<br>
                  {{ $ticket->office_postal }}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <div class="control-label col-xs-3">
                  Requested By
                </div>
                <div class="form-control-static col-xs-9">
                  {{ $ticket->requested_by }}<br>
                  {{ $ticket->requester_mobile }}
                </div>
              </div>
            </div>
          </div>
          
          <div class="form-group">
            <label class="control-label col-md-2">Issues</label>
            <div class="col-md-10">
              <table class="table table-bordered no-margin-btm table-responsive">
                <thead>
                <tr>
                  <th width="255px">Image / Video</th>
                  <th>Issue</th>
                  <th>Expected</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ticket->issues as $issue)
                  <tr>
                    <td>
                      <img src="{{asset('assets/images/tickets/'.$issue->image)}}" class="ticket-image"/>
                    </td>
                    <td>
                      {{ $issue->issue_desc }}
                    </td>
                    <td>
                      {{ $issue->expected_desc }}
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
          
          @if(Auth::user()->type == \App\Models\Enums\UserType::Operator)
            <div class="form-group">
              <label class="control-label col-md-2">Preferred Slots</label>
              <div class="col-md-10">
                <table class="table table-bordered no-margin-btm table-responsive">
                  <thead>
                  <tr>
                    <th width="120px">Date</th>
                    <th>Time</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($ticket->preferred_slots as $slot)
                    <tr>
                      <td>
                        {{ ViewHelper::formatDate($slot->date)}}
                      </td>
                      <td>
                        {{ ViewHelper::formatTime($slot->time_start) }} to {{ ViewHelper::formatTime($slot->time_end) }}
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          @endif
          
          <div class="form-group">
            <label class="control-label col-md-2">Staff Assignments</label>
            <div class="col-md-10">
              <table class="table table-bordered no-margin-btm table-responsive">
                <thead>
                <tr>
                  <th width="120px">Date</th>
                  <th>Staff</th>
                  <th>Time</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ticket->staff_assignments as $date => $assignments)
                  @foreach($assignments as $a)
                    <tr>
                      <td>{{ ViewHelper::formatDate($date) }}</td>
                      <td>{{ $a->staff_name }}</td>
                      <td>{{ ViewHelper::formatTime($a->time_start) }} to {{ ViewHelper::formatTime($a->time_end) }}</td>
                    </tr>
                  @endforeach
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
          
          <div class="form-group">
            <label class="control-label col-md-2">One time passwords</label>
            <div class="col-md-10">
              <table class="table table-bordered no-margin-btm table-responsive">
                @if(ViewHelper::hasAccess('ticket_view_enter_otp'))
                  <tr>
                    <td width="120px">First OTP</td>
                    <td>
                      @if($ticket->otps->first_entered_on)
                        {{ $ticket->otps->first_otp }}
                        <span class="font-green-jungle"><i class="fa fa-check"></i></span>
                        <br>{{ ViewHelper::formatDateTime($ticket->otps->first_entered_on) }}
                      @else
                        <div id="div-first-otp{{$ticket->otps->ticket_otp_id}}">
                          <div class="input-icon right">
                            <i class="fa fa-remove" id="cross-first-otp{{$ticket->otps->ticket_otp_id}}" style="display:none"></i>
                            <input type="text" name='first_otp{{$ticket->otps->ticket_otp_id}}' class="form-control" maxlength="6" style="width:100px">
                          </div>
                          <button type="button" onclick="enterOtp({{$ticket->otps->ticket_otp_id}}, 'first')" class="btn blue">Submit</button>
                        </div>
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td>Second OTP</td>
                    <td>
                      @if($ticket->otps->second_entered_on)
                        {{ $ticket->otps->second_otp }}
                        <span class="font-green-jungle"><i class="fa fa-check"></i></span>
                        <br>{{ ViewHelper::formatDateTime($ticket->otps->second_entered_on) }}
                      @else
                        <div id="div-second-otp{{$ticket->otps->ticket_otp_id}}">
                          <div class="input-icon right">
                            <i class="fa fa-remove" id="cross-second-otp{{$ticket->otps->ticket_otp_id}}" style="display:none"></i>
                            <input type="text" name='second_otp{{$ticket->otps->ticket_otp_id}}' class="form-control" maxlength="6" style="width:100px">
                          </div>
                          <button type="button" onclick="enterOtp({{$ticket->otps->ticket_otp_id}}, 'second')" class="btn blue">Submit</button>
                        </div>
                      @endif
                    </td>
                  </tr>
                @endif
                </tbody>
              </table>
            </div>
          </div>
      </form>
    </div>
  </div>
@endsection

@section('script')
  <script>
    function enterOtp(ticket_otp_id, type) {
      var otp = $("input[name='"+type+"_otp"+ticket_otp_id+"']").val();
      var url = '{{url('api/enterOtp')}}?ticket_otp_id='+ticket_otp_id+'&type='+type+'&otp='+otp;
      //console.log(url);
      axios.get(url)
        .then(function (response) {
          var result = response.data;
          console.log(result);
          if (result == false) {
            $("#cross-"+type+"-otp"+ticket_otp_id).show();
            $("#div-"+type+"-otp"+ticket_otp_id).addClass('has-error');
          } else if (result == true) {
            $("#div-"+type+"-otp"+ticket_otp_id).html(otp +
              ' <span class="font-green-jungle"><i class="fa fa-check"></i></span>' +
              '<br>' + moment().format("D MMMM YYYY, h:mm a")
            );
          }
        })
        .catch(function (error) {
          console.log('enterOtp error='+error);
        })
    }
  </script>

@endsection