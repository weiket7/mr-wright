<style>
  .company-header {
    margin-top: 20px;
    font-size: 16px;
  }
  .div-break {
    margin-bottom: 40px;
  }
  
  .quoted-price {
    font-size: 20px;
  }
</style>

<div class="row">
  <div><b>{{ $ticket->company_name }}</b></div>
  <div>{{ $ticket->office_name }}</div>
  <div>{{ $ticket->office_addr }}</div>
  <div>{{ $ticket->office_postal }}</div>
  <br>
  <div>Requested by {{ $ticket->requested_by }} on {{ ViewHelper::formatDateTime($ticket->requested_on) }}</div>
  <div>Email: {{ $ticket->requester_email }}</div>
  <div>Mobile: {{ $ticket->requester_mobile }}</div>
</div>
<br>

<div class="div-break">
  <h4>Issues</h4>
  <table style="border-collapse: collapse;">
    <thead>
    <tr>
      <th style="border: 1px solid #ddd; padding: 8px;">Image</th>
      <th style="border: 1px solid #ddd; padding: 8px;">Issue</th>
      <th style="border: 1px solid #ddd; padding: 8px;">Expected</th>
    </tr>
    </thead>@foreach($ticket->issues as $issue)
      <tbody>
      <tr>
        <td style="border: 1px solid #ddd; padding: 8px;"><img src="{{asset("assets/images/tickets/".$issue->image)}}" class="ticket-image"></td>
        <td style="border: 1px solid #ddd; padding: 8px;">{{ $issue->issue_desc }}</td>
        <td style="border: 1px solid #ddd; padding: 8px;">{{ $issue->expected_desc }}</td>
      </tr>
      </tbody>
    @endforeach
  </table>
</div>

<div class="div-break">
  <h4>Preferred Slots</h4>
  <table style="border-collapse: collapse;">
    <thead>
    <tr>
      <th style="border: 1px solid #ddd; padding: 8px;">Date</th>
      <th style="border: 1px solid #ddd; padding: 8px;">Time</th>
    </tr>
    </thead>
    @foreach($ticket->preferred_slots as $slot)
      <tbody>
      <tr>
        <td style="border: 1px solid #ddd; padding: 8px;">{{ ViewHelper::formatDate($slot->date) }}</td>
        <td style="border: 1px solid #ddd; padding: 8px;">{{ ViewHelper::formatTime($slot->time_start) }} to {{ ViewHelper::formatTime($slot->time_end) }}</td>
      </tr>
      </tbody>
    @endforeach
  </table>
</div>

@if(isset($show_staff_assignments) && $show_staff_assignments)
  <div class="div-break">
    <h4>Staff Assignments</h4>
    
    <table style="border-collapse: collapse;">
      <thead>
      <tr>
        <th width="120px" style="border: 1px solid #ddd; padding: 8px;">Date</th>
        <th width="160px" style="border: 1px solid #ddd; padding: 8px;">Time</th>
        <th width="200px" style="border: 1px solid #ddd; padding: 8px;">Staff</th>
        <th style="border: 1px solid #ddd; padding: 8px;">Mobile</th>
      </tr>
      </thead>
      <tbody>
      @foreach($ticket->staff_assignments as $date => $assignments)
        @foreach($assignments as $a)
          <tr>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ ViewHelper::formatDate($date) }}</td>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ ViewHelper::formatTime($a->time_start) }} to {{ ViewHelper::formatTime($a->time_end) }}</td>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $a->staff_name }}</td>
            <td style="border: 1px solid #ddd; padding: 8px;">{{ $a->staff_mobile }}</td>
          </tr>
        @endforeach
      @endforeach
      </tbody>
    </table>
  </div>
@endif

@if(isset($show_otp) && $show_otp)
  <div class="div-break">
    <h4>One Time Passwords (OTPs)</h4>
    
    <table style="border-collapse: collapse;">
      <tbody>
      <tr>
        <th style="border: 1px solid #ddd; padding: 8px;">First OTP</th>
        <td style="border: 1px solid #ddd; padding: 8px;">{{ $ticket->otps->first_otp }}</td>
        <td style="border: 1px solid #ddd; padding: 8px;">Provide First OTP to repairman <b><u>upon arrival</u></b>. This helps us keep track of attendance and punctuality of our repairman</td>
      </tr>
      <tr>
        <th style="border: 1px solid #ddd; padding: 8px;">Second OTP</th>
        <td style="border: 1px solid #ddd; padding: 8px;">{{ $ticket->otps->second_otp }}</td>
        <td style="border: 1px solid #ddd; padding: 8px;">Provide Second OTP upon the <b><u>completion</u></b> of the job. DO NOT give OTP to repairman if job is incomplete</td>
      </tr>
      </tbody>
    </table>
  </div>
@endif

<div class="div-break">
  <h4>Description</h4>
  <div>{{ $ticket->requester_desc }}</div>
</div>