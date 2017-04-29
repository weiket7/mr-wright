@extends('frontend.template', ['title'=>'Payment Failed'])

@section('content')
  Payment for {{ $transaction->code }} failed.
@endsection