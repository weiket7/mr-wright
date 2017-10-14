@extends("emails.email-template")

@section('content')
  <blockquote>Ticket {{ $ticket->ticket_code }} first OTP</blockquote>
  
  Hi {{$ticket->name}},
  <br><br>
@endsection