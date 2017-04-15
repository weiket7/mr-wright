@extends('frontend.template', ['title'=>'log in'])

@section('content')
  <form method="post" action="">

    @if(Session::has('msg'))
      <div class="alert alert-danger">
        {{ Session::get('msg') }}
      </div>
    @endif

    {{ csrf_field() }}
    <input class="text-input hint" name="username" type="text" placeholder="Username *" autofocus autocomplete="off" value="{{ App::environment('local') ? "Sally" : '' }}">
    <br><br>

    <input class="text-input hint" name="password" type="password" placeholder="Password *" autocomplete="off" value="{{ App::environment('local') ? "123456" : '' }}">
    <br><br>

    <input type="submit" name="submit" value="LOG IN" class="more active">
  </form>
@endsection