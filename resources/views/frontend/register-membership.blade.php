@extends('frontend.template', ['title'=>'register'])

@section('content')
  <div class="stepwizard">
    <div class="stepwizard-row setup-panel">
      <div class="stepwizard-step">
        <a href="#step-1" type="button" class="btn btn-circle btn-default" disabled="disabled">1</a>
        <p>Step 1</p>
      </div>
      <div class="stepwizard-step">
        <a href="#step-2" type="button" class="btn btn-default btn-circle btn-primary">2</a>
        <p>Step 2</p>
      </div>
    </div>
  </div>
  
  <form method="post" action="" class="form-horizontal" autocomplete="off">
    {{ csrf_field() }}
  
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
        <input type="submit" name="submit" value="SUBMIT" class="more active">
      </div>
    </div>
  </form>
@endsection
