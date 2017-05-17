<style>
  .title {
    margin-bottom: 40px;
  }
  .company-header {
    margin-top: 20px;
    font-size: 16px;
  }
  .div-preferred-slots {
    margin-bottom: 40px;
  }
  .div-staff-assignments {
    margin-bottom: 40px;
  }
  .div-issues {
    margin-bottom: 40px;
  }
  .quoted-price {
    font-size: 20px;
  }
</style>

<div class="row company-header">
  <div class="col-xs-5">
    <div><b>{{ $ticket->company_name }}</b></div>
    <div>{{ $ticket->office_name }}</div>
    <div>{{ $ticket->office_addr }}</div>
    <div>{{ $ticket->office_postal }}</div>
  </div>
  <div class="col-xs-7">
    <div>Requested by {{ $ticket->requested_by }} on {{ ViewHelper::formatDateTime($ticket->requested_on) }}</div>
    <div>Email: {{ $ticket->requester_email }}</div>
    <div>Mobile: {{ $ticket->requester_mobile }}</div>
  </div>
</div>
<br>

<div class="div-issues">
  <h4>Issues</h4>
  <table class="table table-bordered">
    <thead>
    <tr>
      <td>Image</td>
      <td>Issue</td>
      <td>Expected</td>
    </tr>
    </thead>@foreach($ticket->issues as $issue)
      <tbody>
      <tr>
        <td><img src="{{asset("assets/images/tickets/".$issue->image)}}" class="ticket-image"></td>
        <td>{{ $issue->issue_desc }}</td>
        <td>{{ $issue->expected_desc }}</td>
      </tr>
      </tbody>
    @endforeach
  </table>
</div>

<div class="div-preferred-slots">
  <h4>Preferred Slots</h4>
  <table class="table table-bordered">
    <thead>
    <tr>
      <td>Date</td>
      <td>Time</td>
    </tr>
    </thead>
    @foreach($ticket->preferred_slots as $slot)
      <tbody>
      <tr>
        <td>{{ ViewHelper::formatDate($slot->date) }}</td>
        <td>{{ ViewHelper::formatTime($slot->time_start) }} to {{ ViewHelper::formatTime($slot->time_end) }}</td>
      </tr>
      </tbody>
    @endforeach
  </table>
</div>

@if(isset($show_staff_assignments) && $show_staff_assignments)
<div class="div-staff-assignments">
  <h4>Staff Assignments</h4>
  
  <table class="table table-bordered no-margin-btm">
    <thead>
    <tr>
      <th width="120px">Date</th>
      <th width="160px">Time</th>
      <th width="200px">Staff</th>
      <th>Mobile</th>
    </tr>
    </thead>
    <tbody>
    @foreach($ticket->staff_assignments as $date => $assignments)
      @foreach($assignments as $a)
        <tr>
          <td>{{ ViewHelper::formatDate($date) }}</td>
          <td>{{ ViewHelper::formatTime($a->time_start) }} to {{ ViewHelper::formatTime($a->time_end) }}</td>
          <td>{{ $a->staff_name }}</td>
          <td>{{ $a->staff_mobile }}</td>
        </tr>
      @endforeach
    @endforeach
    </tbody>
  </table>
</div>
@endif


@if(isset($show_otp) && $show_otp)
  <div class="div-staff-assignments">
    <h4>One time passwords</h4>

    <p>Please provide the OTP to the service staff on the day itself so that he can indicate his attendance in the system.</p>

    <table class="table table-bordered no-margin-btm">
      <thead>
      <tr>
        <th width="120px">Date</th>
        <th>OTP</th>
      </tr>
      </thead>
      <tbody>
      <div class="form-group">
        <label class="control-label col-md-2">One time passwords</label>
        <div class="col-md-10">
          <table class="table table-bordered no-margin-btm table-responsive">
            <thead>
            <tr>
              <th width="110px">Date</th>
              <th width="100px">First OTP</th>
              <th>Second OTP</th>
            </tr>
            </thead>
            <tbody>
            @if(ViewHelper::hasAccess('ticket_view_otp'))
              @foreach($ticket->otps as $otp)
                <tr>
                  <td>{{ ViewHelper::formatDate($otp->date) }}</td>
                  <td>{{ $otp->first_otp }}</td>
                  <td>{{ $otp->second_otp }}</td>
                </tr>
              @endforeach
            @endif
            </tbody>
          </table>
        </div>
      </div>
      </tbody>
    </table>
  </div>
@endif

<div class="div-requester-desc">
  <h4>Description</h4>
  <div>{{ $ticket->requester_desc }}</div>
</div>