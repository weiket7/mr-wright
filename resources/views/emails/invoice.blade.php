@extends("emails.email-template")

@section('content')
  <style>
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

  <h3>Invoice for <b>{{ $ticket->ticket_code }}</b></h3>

  <div class="title">
    <blockquote>
      <p>{{ $ticket->title }}</p>
    </blockquote>
  </div>

  @include('emails.ticket-content', ['ticket'=>$ticket])

  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title text-center">
        <b class="quoted-price">{{ ViewHelper::formatCurrency($ticket->quoted_price) }}</b><br>

      </h3>
    </div>
    <div class="panel-body text-center">
      To make payment, please <a href="{{url('ticket/pay/'.$ticket->ticket_id)}}">log in to Mr Wright</a>
    </div>
  </div>
@endsection