@extends('frontend.template', ['title'=>'Payment'])

@section('content')
  @if($payment_method == 'R')
    <button type="button" onclick="location.href='{{url('register-success')}}'">Continue</button>

    <form name="payFormCcard" method="post" action="
https://test.paydollar.com/b2c2/eng/payment/payForm.jsp">
      <input type="hidden" name="merchantId" value="1">
      <input type="hidden" name="amount" value="3000.0" >
      <input type="hidden" name="orderRef" value="000000000014">
      <input type="hidden" name="currCode" value="344" >
      <input type="hidden" name="mpsMode" value="NIL" >
      <input type="hidden" name="successUrl"
             value="http://www.yourdomain.com/Success.html">
      <input type="hidden" name="failUrl" value="http://www.yourdomain.com/Fail.html">
      <input type="hidden" name="cancelUrl" value="http://www.yourdomain.com/Cancel.html">
      <input type="hidden" name="payType" value="N">
      <input type="hidden" name="lang" value="E">
      <input type="hidden" name="payMethod" value="CC">
      <input type=”hidden” name=”secureHash” value=” 44f3760c201d3688440f62497736bfa2aadd1bc0”>
      <input type="submit" name="submit">
    </form>
    
  @else
    <h3>Thank you for registering membership with Mr Wright.</h3>
    <br><br>
    
    @if($payment_method == 'Q')
      {!! nl2br($frontend['contents']['payment_cheque']) !!}
    @elseif($payment_method == 'B')
      {!! nl2br($frontend['contents']['payment_banktransfer']) !!}
    @elseif($payment_method == 'R')
      {!! nl2br($frontend['contents']['payment_creditcard']) !!}
    @elseif($payment_method == 'C')
      {!! nl2br($frontend['contents']['payment_cash']) !!}
    @endif
    
    <br><br><br>
    
    After payment has been received, an email will be sent to you.
    <br><br><br>

    If you have questions or encounter any issues, please email us at {{$frontend['contents']['email']}}.
  @endif
@endsection