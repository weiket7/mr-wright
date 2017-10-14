@extends("emails.email-template")

@section('content')
  <blockquote>Registration Approved</blockquote>

  Hi {{$registration->name}},
  <br><br>

  Your registration has been approved.
  <br><br>

  Please log in to begin creating ticket(s).
  
  <br><br>
  <a href="{{url('login')}}" class="btn btn-primary">Log In</a>
@endsection