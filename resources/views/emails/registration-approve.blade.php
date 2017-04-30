@extends("emails.email-template")

@section('content')
  <blockquote>Registration Approved</blockquote>

  Hi {{$registration->name}},
  <br><br>

  Your registration has been approved.
  <br><br>

  Please log in to begin creating ticket(s).
  <br><br>

  <button type='button' class="btn btn-primary" onclick="window.open('{{url('login')}}')">Log In</button>
@endsection