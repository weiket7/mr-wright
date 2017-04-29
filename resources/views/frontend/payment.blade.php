@extends('frontend.template', ['title'=>'payment processing'])

@section('content')
  <form id="form-payment" method="post" action="{{$paydollar_setting['post_url']}}">
    <input type="hidden" name="merchantId" value="{{$paydollar_setting['merchant_id']}}">
    <input type="hidden" name="amount" value="{{ $transaction_request->amount }}" >
    <input type="hidden" name="orderRef" value="{{ $transaction_request->code }}">
    <input type="hidden" name="currCode" value="702" > {{--SGD--}}
    <input type="hidden" name="mpsMode" value="NIL" >
    <input type="hidden" name="successUrl" value="{{url('payment/success')}}">
    <input type="hidden" name="failUrl" value="{{url('payment/fail')}}">
    <input type="hidden" name="cancelUrl" value="{{url('payment/cancel')}}">
    <input type="hidden" name="payType" value="N"> {{--normal--}}
    <input type="hidden" name="lang" value="E"> {{--English--}}
    <input type="hidden" name="payMethod" value="CC"> {{--credit card--}}
    <input type="submit" value="Submit" style="display:none">
  </form>

  <h3>Processing...</h3>
@endsection

@section('script')
  <script>
    $(document).ready(function() {
      $("#form-payment").submit();
    });
  </script>
@endsection
