@extends('frontend.template', ['title'=>'Payment'])

@section('content')
  <h3>Thank you for registering membership with Mr Wright.</h3>
  <br><br>
  
  @if($payment_method == 'Q')
  For cheque payment, please make it payable to Mr Wright:
  @endif

  @if($payment_method == 'C')
  For cash payment, please make payment at:
  @endif

  @if($payment_method == 'B')
  For bank transfer, please transfer to:
  @endif
  <br><br>
  <br><br>

  After payment has been received, an email will be sent to you.
  <br><br><br>
  
  If you have questions or encounter any difficulties, please email {{$frontend['contents']['email']}}.

@endsection