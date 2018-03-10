@extends('frontend.template', ['title'=>'register'])

@section('content')
  <div class="stepwizard">
    <div class="stepwizard-row setup-panel">
      <div class="stepwizard-step">
        <a href="#step-1" type="button" class="btn btn-circle btn-default btn-primary">1</a>
        <p>Step 1</p>
      </div>
      <div class="stepwizard-step">
        <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
        <p>Step 2</p>
      </div>
    </div>
  </div>

  <form method="post" action="" class="form-horizontal" autocomplete="off">
    {{ csrf_field() }}

    @if($membership_id)
      {{ Form::hidden('membership_id', $membership_id) }}
    @endif

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Username *
          </label>
          <div class="col-md-9">
            {{ Form::text('username', '', ['class'=>'form-control', 'maxlength'=>20]) }}
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
            {{ Form::text('name', '', ['class'=>'form-control', 'maxlength'=>50]) }}
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Designation *
          </label>
          <div class="col-md-9">
            {{ Form::text('designation', '', ['class'=>'form-control', 'maxlength'=>30]) }}
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
            {{ Form::text('mobile', '', ['class'=>'form-control', 'maxlength'=>30]) }}
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Email *
          </label>
          <div class="col-md-9">
            {{ Form::email('email', '', ['class'=>'form-control', 'maxlength'=>100]) }}
          </div>
        </div>
      </div>
    </div>

    <hr>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Company Name *
          </label>
          <div class="col-md-9">
            {{ Form::text('company_name', '', ['class'=>'form-control', 'maxlength'=>50]) }}
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Unique Entity Number (UEN) *
          </label>
          <div class="col-md-9">
            {{ Form::text('uen', '', ['class'=>'form-control', 'maxlength'=>50]) }}
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
            {{ Form::textarea('addr', '', ['class'=>'form-control', 'rows'=>3, 'maxlength'=>200]) }}
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Postal Code *
          </label>
          <div class="col-md-9">
            {{ Form::number('postal', '', ['class'=>'form-control', 'maxlength'=>20]) }}
          </div>
        </div>
      </div>
    </div>

    <div class="margin-top-30">
      <div class="align-center">
        <input type="submit" name="submit" value="CONTINUE" class="more active">
      </div>
    </div>
  </form>
@endsection
