@extends("emails.email-template")

@section('content')
  Hi {{ $user->name }},
  <br><br>

  We received a forgot password request for username: {{ $user->username }}.
  <br><br>

  Please log in with this new password and reset it at Account page:
  <br>

  <div class="well">
    <b>{{ $new_password }}</b>
  </div>

  <br><br>
  <div>
    <a href="{{url('login')}}" class="btn btn-primary">Log In</a>
  </div>

@endsection