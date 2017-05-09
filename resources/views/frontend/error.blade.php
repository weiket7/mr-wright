@extends('frontend.template', ['title'=>'error'])

@section('content')
  <div class="alert alert-danger margin-top-40">
    @if(session()->has('error'))
      {{session()->get('error')}}
    @elseif(isset($error))
      {{ $error }}
    @else
      An error occurred
    @endif
  </div>
@endsection