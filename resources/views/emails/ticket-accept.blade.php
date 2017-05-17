@extends("emails.email-template")

@section('content')
  <h3>Ticket {{ $ticket->ticket_code }} Accepted</h3>
  
  <div class="title">
    <blockquote>
      <p>{{ $ticket->title }}</p>
    </blockquote>
  </div>

  @include('frontend.ticket-content', [
    'show_staff_assignments'=>true,
    'show_otp'=>true,
  ])
@endsection