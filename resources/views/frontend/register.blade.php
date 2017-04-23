@extends('frontend.template', ['title'=>'register'])

@section('content')
  <form method="post" action="" class="form-horizontal" autocomplete="off" id="app" >
    {{ csrf_field() }}

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Username *
          </label>
          <div class="col-md-9">
            {{ Form::text('username', '', ['class'=>'form-control']) }}
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Password *
          </label>
          <div class="col-md-9">
            {{ Form::password('password', ['class'=>'form-control']) }}
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
            {{ Form::text('name', '', ['class'=>'form-control']) }}
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Designation *
          </label>
          <div class="col-md-9">
            {{ Form::text('designation', '', ['class'=>'form-control']) }}
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
            {{ Form::text('mobile', '', ['class'=>'form-control']) }}
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Email *
          </label>
          <div class="col-md-9">
            {{ Form::email('email', '', ['class'=>'form-control']) }}
          </div>
        </div>
      </div>
    </div>

    <hr>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Unique Entity Number (UEN) *
          </label>
          <div class="col-md-9">
            {{ Form::text('uen', '', ['class'=>'form-control']) }}
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Company Name *
          </label>
          <div class="col-md-9">
            {{ Form::text('company_name', '', ['class'=>'form-control']) }}
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      {{--<div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Office  Name *
          </label>
          <div class="col-md-9">
            <input type="text" name="office_name" class="form-control">
          </div>
        </div>
      </div>--}}
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Address *
          </label>
          <div class="col-md-9">
            {{ Form::textarea('addr', '', ['class'=>'form-control', 'rows'=>3]) }}
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Postal Code *
          </label>
          <div class="col-md-9">
            {{ Form::text('postal', '', ['class'=>'form-control']) }}
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Membership Plan *
          </label>
          <div class="col-md-9">
            {{ Form::select('membership_id', $memberships, '', ['placeholder'=>'', 'class'=>'form-control']) }}
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Payment Method *
          </label>
          <div class="col-md-9">
            {{ Form::select('payment_method', $payment_methods, '', ['placeholder'=>'', 'class'=>'form-control']) }}
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
@endsection
