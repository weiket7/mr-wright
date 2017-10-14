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
    <div class="panel-heading">
      <h3 class="panel-title text-center">
        <b class="quoted-price">{{ ViewHelper::formatCurrency($ticket->quoted_price) }}</b><br>
        Quoted by {{ $ticket->quoted_by }} on {{ ViewHelper::formatDateTime($ticket->quoted_on)}}
      </h3>
    </div>
    <div class="panel-body text-center">
      <a href="{{url('ticket/view/'.$ticket->ticket_id)}}" class="btn btn-lg btn-success">
        Accept
      </a>
      <a href="{{url('ticket/view/'.$ticket->ticket_id)}}" class="btn btn-lg btn-danger">
        Decline
      </a>
    </div>
    <div class="panel-footer text-center">Valid till {{ ViewHelper::formatDate($ticket->quote_valid_till) }} (inclusive)</div>
  </div>
@endsection