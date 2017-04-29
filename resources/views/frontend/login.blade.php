@extends('frontend.template', ['title'=>'log in'])

@section('content')
  <form method="post" action="" class="form-horizontal">

    @if(Session::has('login_error'))
      <div class="alert alert-danger">
        {{ Session::get('login_error') }}
      </div>
    @endif

    {{ csrf_field() }}

    <div class="form-group">
      <div class="control-label col-md-2">
        Username
      </div>
      <div class="col-md-9">
        {{Form::text('username', App::environment('local') ? "Sally" : '', ['class'=>'form-control', 'autofocus'])}}
      </div>
    </div>

    <div class="form-group">
      <div class="control-label col-md-2">
        Password
      </div>
      <div class="col-md-9">
        {{Form::password('password', ['class'=>'form-control', 'value'=>App::environment('local') ? "123456" : ''])}}
      </div>
    </div>

    <div class="text-center">
      <input type="submit" name="submit" value="LOG IN" class="more active">
      &nbsp;&nbsp;<a href="{{url('forgot-password')}}">Forgot password</a>
    </div>
  </form>
@endsection