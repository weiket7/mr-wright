@extends('frontend.template', ['title'=>'accept invite'])

@section('content')
  <form method="post" action="" class="margin-top-40 form-horizontal">
    {{csrf_field()}}

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
            {{ Form::email('email', $invite->email, ['class'=>'form-control']) }}
          </div>
        </div>
      </div>
    </div>

    <div class="margin-top-30">
      <div class="align-center">
        <input type="submit" name="submit" value="INVITE" class="more active">
      </div>
    </div>

  </form>
@endsection