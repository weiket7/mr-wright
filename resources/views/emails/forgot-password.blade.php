@extends("emails.email-template")

@section('content')
  Hi {{ $name }},
  <br><br>

  We received a forgot password request for {{ $email }}.
  <br><br>

  Please log in with this new password and reset it at Account page:
  <br>

  <div class="well">
    <b>{{ $new_password }}</b>
  </div>

  <div class="text-center">
    <button type='button' class="btn btn-primary" onclick="window.open('{{url('login')}}')">Log In</button>
  </div>

@endsection