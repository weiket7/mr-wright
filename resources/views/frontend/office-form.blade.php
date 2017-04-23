@extends('frontend.template', ['title'=>$action. ' office'])

@section('content')
  <form method="post" action="" class="form-horizontal">
    {{ csrf_field() }}

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Office Name
          </label>
          <div class="col-md-9">
            {{ Form::text('name', $office->name, ['class'=>'form-control', 'maxlength'=>50]) }}
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Number of Requesters
          </label>
          <label class="form-control-static col-md-9">
            {{ $requester_count }}
          </label>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Address
          </label>
          <div class="col-md-9">
            {{Form::textarea('addr', $office->addr, ['class'=>'form-control', 'rows'=>3, 'maxlength'=>200])}}
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Postal
          </label>
          <div class="col-md-9">
            {{ Form::text('postal', $office->postal, ['class'=>'form-control', 'maxlength'=>20]) }}
          </div>
        </div>
      </div>
    </div>

    <div class="margin-top-30">
      <div class="align-center">
        <input type="submit" name="submit" value="SAVE" class="more active">
      </div>
    </div>

  </form>
@endsection