@extends("emails.email-template")

@section('content')
  <style>
    .mr-wright-logo {
      height: 40px;
      margin-bottom: 20px;
    }
    .title {
      margin-bottom: 40px;
    }
    .company-header {
      margin-top: 20px;
      font-size: 16px;
    }
    .div-requester-desc {
      margin-bottom: 40px;
    }
    .div-preferred-slots {
      margin-bottom: 40px;
    }
    .div-issues {
      margin-bottom: 40px;
    }
    .quoted-price {
      font-size: 20px;
    }
  </style>

  <img src="{{asset("images/mr-wright-logo.png")}}" class="mr-wright-logo">

  <h3>Invoice for <b>{{ $ticket->ticket_code }}</b></h3>

  <div class="title">
    <blockquote>
      <p>{{ $ticket->title }}</p>
    </blockquote>
  </div>

  <div class="row company-header">
    <div class="col-xs-5">
      <div><b>{{ $ticket->company_name }}</b></div>
      <div>{{ $ticket->office->name }}</div>
      <div>{{ $ticket->office->addr }}</div>
      <div>{{ $ticket->office->postal }}</div>
    </div>
    <div class="col-xs-7">
      <div>Requested by {{ $ticket->requested_by }} on {{ ViewHelper::formatDateTime($ticket->requested_on) }}</div>
      <div>Email: {{ $ticket->requester->email }}</div>
      <div>Mobile: {{ $ticket->requester->mobile }}</div>
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
          <td><img src="{{asset("images/tickets/".$issue->image)}}" class="ticket-image"></td>
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

  <div class="div-requester-desc">
    <h4>Requester Description</h4>
    <div>{{ $ticket->requester_desc }}</div>
  </div>


  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title text-center">
        <b class="quoted-price">{{ ViewHelper::formatCurrency($ticket->quoted_price) }}</b><br>

      </h3>
    </div>
    <div class="panel-body text-center">
      Please make payment to Mr Wright via:<br>
      1.<br>
      2.
    </div>
    <div class="panel-footer text-center">Valid till {{ ViewHelper::formatDate($ticket->quote_valid_till) }} (inclusive)</div>
  </div>
@endsection