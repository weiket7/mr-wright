@extends('frontend.template', ['title'=>'Registration Success'])

@section('content')
  <h3>Thank you for registering membership with Mr Wright.</h3>
  <br><br>

  @if(session()->has('register-existing-uen'))
    The admin of UEN {{$registration->uen}} has been informed and he will verify your identify and approve or reject your registration.
    <br><br>

    When the admin approves your registration, an email will be sent to you.
    <br><br>

    If you have questions or encounter any issues, please email {{$frontend['contents']['email']}}.
  @endif
@endsection