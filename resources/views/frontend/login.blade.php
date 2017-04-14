@extends('frontend.template')

@section('content')
  <div class="row page-margin-top">

    <h3 class="box-header">Log In</h3>

    <form method="post" action="" class="margin-top-40 margin-bottom-40">
      {{ csrf_field() }}
      <input class="text-input hint" name="username" type="text" placeholder="Username *" autofocus autocomplete="off">
      <br><br>

      <input class="text-input hint" name="password" type="password" placeholder="Password *" autocomplete="off">
      <br><br>

      <input type="submit" name="submit" value="LOG IN" class="more active">
    </form>
  </div>
@endsection