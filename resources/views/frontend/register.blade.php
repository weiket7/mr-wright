@extends('frontend.template')

@section('content')
  <style>
    .txt {
      width: 90%
    }
  </style>


  <div class="r-row gray full-width page-header vertical-align-table">
    <div class="r-row full-width padding-top-bottom-50 vertical-align-cell">
      <div class="r-row">
        <h3 class="box-header">REGISTER</h3>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-8">.col-md-8</div>
    <div class="col-md-4">.col-md-4</div>
  </div>

  <div class="r-row margin-bottom-40">
    <form method="post" action="" class="margin-top-40">
      {{ csrf_field() }}
      <div class="r-row">
        <div class="column column-1-2">
          <input class="txt" name="name" type="text" placeholder="Username *" autofocus>
        </div>
        <div class="column column-1-2">
          <input class="txt" name="designation" type="text" placeholder="Password *">
        </div>
      </div>

      <div class="r-row margin-top-20">
        <div class="column column-1-2">
          <input class="txt" name="name" type="text" placeholder="Your Name *">
        </div>
        <div class="column column-1-2">
          <input class="txt" name="designation" type="text" placeholder="Designation *">
        </div>
      </div>

      <div class="r-row margin-top-20">
        <div class="column column-1-2">
          <input class="txt" name="name" type="text" placeholder="Mobile *">
        </div>
        <div class="column column-1-2">
          <input class="txt" name="designation" type="text" placeholder="Email *">
        </div>
      </div>

      <div class="r-row margin-top-20">
        <div class="column column-1-2">
          <input class="txt" name="name" type="text" placeholder="Company Name *">
        </div>
        <div class="column column-1-2">
          <input class="txt" name="designation" type="text" placeholder="Office Name *">
        </div>
      </div>

      <div class="r-row margin-top-20">
        <div class="column column-1-2">
          <input class="txt" name="name" type="text" placeholder="Address *">
        </div>
        <div class="column column-1-2">
          <input class="txt" name="designation" type="text" placeholder="Postal *">
        </div>
      </div>

      <div class="r-row margin-top-30">
        <div class="align-center">
          <input type="submit" name="submit" value="REGISTER" class="more active">
        </div>
      </div>
    </form>
  </div>

@endsection