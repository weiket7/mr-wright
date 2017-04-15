@extends('frontend.template', ['title'=>'register'])

@section('content')
  <div class="r-row gray full-width page-header vertical-align-table">
    <div class="r-row full-width padding-top-bottom-50 vertical-align-cell">
      <div class="r-row">
        <div class="page-header-left">
          <h1>REGISTER</h1>
        </div>
      </div>
    </div>
  </div>

  <div class="r-row page-margin-top margin-bottom-40">
    <form method="post" action="" class="form-horizontal">
      {{ csrf_field() }}

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Username *
            </label>
            <div class="col-md-9">
              <input type="text" name="username" class="form-control" autofocus>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Password *
            </label>
            <div class="col-md-9">
              <input type="password" name="password" class="form-control">
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Full Name *
            </label>
            <div class="col-md-9">
              <input type="text" name="name" class="form-control">
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Designation *
            </label>
            <div class="col-md-9">
              <input type="text" name="designation" class="form-control">
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Mobile *
            </label>
            <div class="col-md-9">
              <input type="text" name="mobile" class="form-control">
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Email *
            </label>
            <div class="col-md-9">
              <input type="email" name="email" class="form-control">
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Company Name *
            </label>
            <div class="col-md-9">
              <input type="text" name="company_name" class="form-control">
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Office Name *
            </label>
            <div class="col-md-9">
              <input type="text" name="office_name" class="form-control">
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Address *
            </label>
            <div class="col-md-9">
              <input type="text" name="addr" class="form-control">
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Postal Code *
            </label>
            <div class="col-md-9">
              <input type="text" name="postal" class="form-control">
            </div>
          </div>
        </div>
      </div>

      <div class="margin-top-30">
        <div class="align-center">
          <input type="submit" name="submit" value="REGISTER" class="more active">
        </div>
      </div>
    </form>
  </div>

@endsection