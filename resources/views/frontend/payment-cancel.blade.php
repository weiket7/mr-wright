@extends('frontend.template', ['title'=>'Payment Cancelled'])

@section('content')
  Payment for {{ $transaction->code }} was cancelled.
@endsection