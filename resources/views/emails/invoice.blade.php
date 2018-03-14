@extends("emails.email-template")

@section('content')
  <h3>Invoice for <b>{{ $ticket->ticket_code }}</b></h3>

  <div class="title">
    <blockquote>
      <p>{{ $ticket->title }}</p>
    </blockquote>
  </div>

  @include('emails.ticket-content', ['ticket'=>$ticket])

  <div class="panel panel-default">
    <div class="panel-heading" style="color: #333;
      background-color: #f5f5f5; border-color: #ddd; text-align: center; padding: 10px 15px;
      border-top: 1px solid #ddd;
      border-bottom: 1px solid #ddd;
    ">
      <span class="panel-title text-center" style="font-size: 16px;">
        <b class="quoted-price">{{ ViewHelper::formatCurrency($ticket->quoted_price) }}</b><br>
      </span>
    </div>
    <div class="panel-body text-center" style="padding: 15px; text-align:center;">
      To make payment, please <a href="{{url('ticket/pay/'.$ticket->ticket_id)}}">log in to Mr Wright</a>
    </div>
  </div>
@endsection