@extends("emails.email-template")

@section('content')
  <h3>Mr Wright - Registration Approved</h3>

  Hi {{$registration->name}},
  <br><br>

  Your registration has been approved.
  <br><br>

  Please log in to create a ticket.
  <br>

  <div class="text-center">
    <button type='button' class="btn btn-primary" onclick="window.open('{{url('login')}}')">Log In</button>
  </div>
@endsection