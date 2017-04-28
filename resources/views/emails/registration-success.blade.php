@extends("emails.email-template")

@section('content')
  <h3>Mr Wright - Registration Success</h3>
  
  Hi {{$registration->name}},
  <br><br>

  Your registration was successful.
  <br><br>
  
  Please log in to begin creating ticket(s).
  <br>
  
  <div class="text-center">
    <button type='button' class="btn btn-primary" onclick="window.open('{{url('login')}}')">Log In</button>
  </div>
@endsection