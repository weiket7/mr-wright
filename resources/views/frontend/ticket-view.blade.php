<?php use App\Models\Enums\TicketStat; ?>
<?php use App\Models\Enums\TicketUrgency; ?>
<?php use Carbon\Carbon; ?>

@extends('frontend.template', ['title'=>strtoupper($action). ' TICKET'])

@section('content')
  <form method="post" action="" class="form-horizontal" id="app">
    {{ csrf_field() }}

    <div class="form-group">
      <label class="control-label col-md-2">
        Title
      </label>
      <div class="col-md-10">
        <div class="form-control-static">
          {{ $ticket->title }}
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Ticket Code
          </label>
          <div class="col-md-9">
            <div class="form-control-static">
              {{ $ticket->ticket_code }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Status
          </label>
          <div class="col-md-9">
            <div class="form-control-static">
              {{ TicketStat::$values[$ticket->stat] }}
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Category
          </label>
          <div class="col-md-9">
            <div class="form-control-static">
              {{ $ticket->category_name }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Urgency
          </label>
          <div class="col-md-9">
            <div class="form-control-static">
              {{ TicketUrgency::$values[$ticket->urgency] }}
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Quoted Price
          </label>
          <div class="col-md-9">
            <div class="form-control-static">
              {{ ViewHelper::formatCurrency($ticket->quoted_price) }}
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Company Name
          </label>
          <div class="col-md-9">
            <div class="form-control-static">
              {{ $ticket->company_name }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Office Name
          </label>
          <div class="col-md-9">
            <div class="form-control-static">
              {{ $ticket->office_name }}
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Address
          </label>
          <div class="col-md-9">
            <div class="form-control-static">
              {{ $ticket->office_addr }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Postal Code
          </label>
          <div class="col-md-9">
            <div class="form-control-static">
              {{ $ticket->office_postal }}
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Requested By
          </label>
          <div class="col-md-9">
            <div class="form-control-static">
            {{ $ticket->requested_by }} on {{ ViewHelper::formatDateTime(Carbon::now()) }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Description
          </label>
          <div class="col-md-9">
            <div class="form-control-static">
              {!! nl2br($ticket->requester_desc) !!}
            </div>
          </div>
        </div>
      </div>
    </div>
    
    @if($ticket->payment_method)
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Payment Method
            </label>
            <div class="col-md-9">
              <div class="form-control-static">
                {{ $ticket->ref_no }}
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Ref No
            </label>
            <div class="col-md-9">
              <div class="form-control-static">
                {{ $ticket->ref_no }}
              </div>
            </div>
          </div>
        </div>
      </div>
    @endif

    <div class="form-group">
      <label class="control-label col-md-2">Issues</label>
      <div class="col-md-10">
        <table class="table table-bordered no-margin-btm">
          <thead>
          <tr>
            <th width="255px">Image / Video</th>
            <th>Issue</th>
            <th>Expected Outcome</th>
          </tr>
          </thead>
          <tbody>
          @foreach($ticket->issues as $issue)
            <tr>
              <td>
                @if($issue->image != '')
                  @if(ViewHelper::isImage($issue->image))
                    <img src="{{asset('assets/images/tickets/'.$issue->image)}}" class="ticket-image"/>
                  @else
                    <video width="320" height="240" controls>
                      <source src="{{asset('assets/images/tickets/'.$issue->image)}}">
                      Your browser does not support the video tag.
                    </video>
                  @endif
                @endif
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

    <div class="form-group">
      <label class="control-label col-md-2">Preferred Slots</label>
      <div class="col-md-10">
        <table class="table table-bordered no-margin-btm">
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

    @if(ViewHelper::frontendShowStaffAssignments($ticket->stat) )
      <div class="form-group">
        <label class="control-label col-md-2">Staff Assignments</label>
        <div class="col-md-10">
          <table class="table table-bordered no-margin-btm">
            <thead>
            <tr>
              <th width="120px">Date</th>
              <th width="200px">Staff</th>
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
    @endif
  
    @if(ViewHelper::frontendShowOtps($ticket->stat) )
    <div class="form-group">
      <label class="control-label col-md-2">One time passwords</label>
      <div class="col-md-10">

        <table class="table table-bordered no-margin-btm">
          <thead>
          <tr>
            <th width="110px">Date</th>
            <th width="100px">First OTP</th>
            <th>Second OTP</th>
          </tr>
          </thead>
          <tbody>
            @foreach($ticket->otps as $otp)
              <tr>
                <td>{{ ViewHelper::formatDate($otp->date) }}</td>
                <td>{{ $otp->first_otp }}</td>
                <td>{{ $otp->second_otp }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    @endif

    @if($ticket->stat == TicketStat::Quoted)
      @if($quote_valid)
        <div style="margin-bottom: 10px;">
            <textarea name="accept_decline_reason" title="" class="form-control txt-decline-reason" placeholder="[Optional] Please share with us the reason for accepting or declining">
            </textarea>
        </div>

        <div>
          <button type="submit" name="submit" class="btn btn-primary" value="Accept">
            Accept
          </button>
          <button type="submit" name="submit" class="btn btn-primary" value="Decline">
            Decline
          </button>
        </div>
      @else
        <div class="alert alert-danger">
          Sorry, the quotation has expired. Please <a href="{{url('ticket/save')}}">create another ticket</a>.
        </div>
      @endif
    @elseif($ticket->stat == TicketStat::Invoiced)
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-2">
              <label class="control-label">Payment Method</label>
            </div>
            <div class="col-md-10">
              @foreach($payment_methods as $value => $name)
                <label class="lbl-radio">
                  <input v-model="payment_method" type="radio" name="payment_method" value="{{$value}}"> {{ $name }}
                  <span></span>
                </label><br>
              @endforeach
            </div>
          </div>
          <div class="row" v-if="payment_method == 'Q' || payment_method == 'B'" >
            <div class="col-md-2">
              <label class="control-label">Ref No</label>
            </div>
            <div class="col-md-10">
              <input type="text" name="ref_no" class="form-control">
            </div>
          </div>
          <div class="row" v-if="payment_method">
            <div class="col-md-12">
              <div class="alert alert-info" style="margin-top: 10px;">
                <div v-if="payment_method == 'C'">
                  {!! nl2br($frontend['contents']['payment_cash']) !!}
                </div>
                <div v-if="payment_method == 'N'">
                  {!! nl2br($frontend['contents']['payment_nets']) !!}
                </div>
                <div v-if="payment_method == 'Q'">
                  {!! nl2br($frontend['contents']['payment_cheque']) !!}
                </div>
                <div v-if="payment_method == 'B'">
                  {!! nl2br($frontend['contents']['payment_banktransfer']) !!}
                </div>
                <div v-if="payment_method == 'R'">
                  {!! nl2br($frontend['contents']['payment_creditcard']) !!}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    @elseif($ticket->stat == TicketStat::PaymentIndicated)
      
    @endif
  
    <div class="text-center">
      @if($ticket->stat == TicketStat::Invoiced)
        <input type="submit" name="submit" value="PAYMENT" class="more active">
      @endif
      <input type="button" name="submit" value="BACK TO TICKETS" class="more active" onclick="location.href='{{url('ticket')}}'">
    </div>
  </form>
@endsection


@section('script')
  <script>
    var vm = new Vue({
      el: "#app",
      data: {
        payment_method: ''
      }
    });
  </script>
@endsection