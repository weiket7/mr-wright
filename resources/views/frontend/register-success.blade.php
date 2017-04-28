@extends('frontend.template', ['title'=>'Registration Success'])

@section('content')
  <h3>Thank you for registering membership with Mr Wright.</h3>
  <br><br>

  @if($registration->register_existing_uen)
    The admin of UEN {{$registration->uen}} has been informed and he will verify your identify and approve or reject your registration.
    <br><br>

    When the admin approves your registration, an email will be sent to you.
    
  @endif

  
  <br><br><br>

  If you have questions or encounter any issues, please email {{$frontend['contents']['email']}}.
@endsection