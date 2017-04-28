@extends('frontend.template', ['title'=>'Payment'])

@section('content')
  <h3>Thank you for registering membership with Mr Wright.</h3>
  <br><br>

  @if($payment_method == 'C')
    {!! nl2br($frontend['contents']['payment_cash']) !!}
  @elseif($payment_method == 'N')
    {!! nl2br($frontend['contents']['payment_nets']) !!}
  @elseif($payment_method == 'Q')
    {!! nl2br($frontend['contents']['payment_cheque']) !!}
  @elseif($payment_method == 'B')
    {!! nl2br($frontend['contents']['payment_banktransfer']) !!}
  @elseif($payment_method == 'R')
    {!! nl2br($frontend['contents']['payment_creditcard']) !!}
  @endif
  <br><br><br>

  After payment has been received, an email will be sent to you.
  <br><br><br>
  
  If you have questions or encounter any issues, please email {{$frontend['contents']['email']}}.
@endsection