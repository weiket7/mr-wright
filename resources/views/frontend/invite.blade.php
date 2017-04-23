@extends('frontend.template', ['title'=>'invite'])

@section('content')
  <form method="post" action="" class="margin-top-40 form-horizontal">
  {{csrf_field()}}

    <div class="r-row">
        <div class="form-group">
          <label class="control-label col-md-2">
            Email
          </label>
          <div class="col-md-10">
            {{ Form::email('email', '', ['class'=>'form-control']) }}
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