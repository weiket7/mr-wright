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
      <table class="table table-bordered">
        <thead>
        <tr>
          <th width="150px">Ticket Code</th>
          <th>Company</th>
          <th>Requested By</th>
          <th>Assignments</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tickets as $ticket)
          <tr>
            <td>
              <a href="{{url('admin/staff/otp/'.$ticket->ticket_id)}}">{{ $ticket->ticket_code }}</a>
            </td>
            <td>
              {{ $ticket->company_name }}<br>
              {{ $ticket->office_name }}<br>
              {{ $ticket->office_addr }}<br>
              {{ $ticket->office_postal }}
            </td>
            <td>{{$ticket->requested_by}} on {{ViewHelper::formatDateTime($ticket->requested_on) }}</td>
            <td>
              <table class="table table-bordered">
              @foreach($ticket->staff_assignments as $date => $assignments)
                @foreach($assignments as $assignment)
                <tr>
                  <td>{{ $assignment->staff_name }}</td>
                  <td>{{ $assignment->staff_mobile }}</td>
                  <td>{{ ViewHelper::formatDate($assignment->date) }}</td>
                  <td>{{ ViewHelper::formatTime($assignment->time_start) }}</td>
                  <td>{{ ViewHelper::formatTime($assignment->time_end) }}</td>
                </tr>
                  @endforeach
                @endforeach
              </table>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
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
          if (result == false) {
            $("#cross-"+type+"-otp"+ticket_otp_id).show();
            $("#div-"+type+"-otp"+ticket_otp_id).addClass('has-error');
          } else if (result == true) {
            $("#div-"+type+"-otp"+ticket_otp_id).html(otp + ' <span class="font-green-jungle"><i class="fa fa-check"></i></span>');
          }
        })
        .catch(function (error) {
          console.log('enterOtp error='+error);
        })
    }
  </script>

@endsection