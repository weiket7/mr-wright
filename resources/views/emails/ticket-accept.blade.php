@extends("emails.email-template")

@section('content')
  <h3>Ticket {{ $ticket->ticket_code }} Accepted</h3>
  
  <div class="title">
    <blockquote>
      <p>{{ $ticket->title }}</p>
    </blockquote>
  </div>

  @include('emails.ticket-content', ['show_staff_assignments'=>true])
@endsection