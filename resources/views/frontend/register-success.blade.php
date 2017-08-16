<?php use App\Models\Enums\RegistrationStat; ?>

@extends('frontend.template', ['title'=>'Registration Success'])

@section('content')
  <div class="r-text">
    <h3>Thank you for registering membership with Mr Wright.</h3>
    <br><br>
  
    @if($registration->existing_uen)
      The admin of UEN {{$registration->uen}} has been informed and he will verify your identify and approve or reject your registration.
      <br><br>
  
      When the admin approves your registration, an email will be sent to you.
    @elseif($registration->stat == RegistrationStat::Approved)
      Please log in to begin creating tickets.
      <br><br>
  
      <div>
        <input type="button" name="submit" value="LOG IN" onclick="location.href='{{url('login')}}'" class="more active">
      </div>
    @else
      @if($registration->payment_method == 'Q')
        {!! nl2br($frontend['contents']['payment_cheque']) !!}
      @elseif($registration->payment_method == 'B')
        {!! nl2br($frontend['contents']['payment_banktransfer']) !!}
      @elseif($registration->payment_method == 'C')
        {!! nl2br($frontend['contents']['payment_cash']) !!}
      @endif
      <br><br><br>
  
      After payment has been received, an email will be sent to you and you will be able to log in to create tickets.
    @endif
  
    <br><br><br>
    If you have questions or encounter issues, please email us at {{$frontend['contents']['email']}}.
  </div>
@endsection