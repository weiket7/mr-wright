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
      <label class="control-label col-md-2">
        Username
      </label>
      <div class="col-md-10">
        <input type="text" name="username" class="form-control" autofocus>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-md-2">
        Password
      </label>
      <div class="col-md-10">
        <input type="password" name="password" value="123456" class="form-control">
      </div>
    </div>

    <div class="text-center">
      <input type="submit" name="submit" value="LOG IN" class="more active"> &nbsp;&nbsp;&nbsp;
      <input type="button" onclick="location.href='{{ url('register') }}'" value="REGISTER" class="more active">
    &nbsp;&nbsp;<br><br>
      <a href="{{url('forgot-password')}}">Forgot password</a>
    </div>
  </form>
@endsection