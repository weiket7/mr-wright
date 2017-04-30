@extends("emails.email-template")

@section('content')
  <blockquote>Registration Success</blockquote>

  Hi {{$registration->name}},
  <br><br>

  Thank you for registering membership with Mr Wright.
  <br><br>

  @if($registration->existing_uen)
    The admin of UEN {{$registration->uen}} has been informed and he will verify your identity and approve or reject your registration.
    <br><br>

    When the admin approves your registration, an email will be sent to you.
  @else
    @if($registration->payment_method == 'Q')
      {!! nl2br($frontend['contents']['payment_cheque']) !!}
    @elseif($registration->payment_method == 'B')
      {!! nl2br($frontend['contents']['payment_banktransfer']) !!}
    @elseif($registration->payment_method == 'C')
      {!! nl2br($frontend['contents']['payment_cash']) !!}
    @endif
    <br><br>

    After payment has been received, an email will be sent to you and you will be able to log in to create tickets.
  @endif
@endsection