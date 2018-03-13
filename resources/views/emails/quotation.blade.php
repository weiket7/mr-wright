@extends("emails.email-template")

@section('content')
  <h3>Quotation for <b>{{ $ticket->ticket_code }}</b></h3>

  <div class="title">
    <blockquote>
      <p>{{ $ticket->title }}</p>
    </blockquote>
  </div>

  @include('emails.ticket-content')

  <div class="panel panel-default">
    <div class="panel-heading" style="color: #333;
      background-color: #f5f5f5; border-color: #ddd; text-align: center; padding: 10px 15px;
      border-top: 1px solid #ddd;
      border-bottom: 1px solid #ddd;
    ">
      <span class="panel-title text-center" style="font-size: 16px;">
        <b class="quoted-price">{{ ViewHelper::formatCurrency($ticket->quoted_price) }}</b><br>
        Quoted by {{ $ticket->quoted_by }} on {{ ViewHelper::formatDateTime($ticket->quoted_on)}}
      </span>
    </div>
    <div class="panel-body text-center" style="padding: 15px; text-align:center;">
      <a href="{{url('ticket/view/'.$ticket->ticket_id)}}" class="btn btn-lg btn-success" style="padding: 10px 16px;
        color: #fff;
        background-color: #5cb85c;
        border-color: #4cae4c;
        display: inline-block;
        font-size: 18px;
        line-height: 1.3333333;
        border-radius: 6px;
        cursor: pointer;    text-decoration: none;
        border: 1px solid transparent;">
        Accept
      </a>
      <a href="{{url('ticket/view/'.$ticket->ticket_id)}}" class="btn btn-lg btn-danger" style="padding: 10px 16px;
      color: #fff;
      background-color: #d9534f;
      border-color: #d43f3a;
      display: inline-block;
      font-size: 18px;
      line-height: 1.3333333;
      border-radius: 6px;
      cursor: pointer;    text-decoration: none;
      border: 1px solid transparent;">
        Decline
      </a>
    </div>
    <div class="panel-footer text-center" style="padding: 10px 15px;
      text-align: center;
      background-color: #f5f5f5;
      border-top: 1px solid #ddd;
      border-bottom: 1px solid #ddd;">
      Valid till {{ ViewHelper::formatDate($ticket->quote_valid_till) }} (inclusive)
    </div>
  </div>
@endsection