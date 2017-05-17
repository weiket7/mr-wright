<?php use App\Models\Enums\RequesterStat; ?>
<?php use App\Models\Enums\PreferredContact; ?>

@extends('frontend.template', ['title'=>$action. ' Member'])

@section('content')
  <form method="post" action="" class="form-horizontal">
    {{ csrf_field() }}

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">Username <span class="required">*</span></label>
          <div class="col-md-9">
            @if($action == 'update')
              <label class="form-control-static">{{ $requester->username }}</label>
            @else
              {{Form::text('username', $requester->username, ['class'=>'form-control', 'maxlength'=>30])}}
            @endif
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">Status</label>
          @if($requester->requester_id == null)
            <label class="col-md-9 form-control-static">
              {{ RequesterStat::$values[RequesterStat::Active] }}
            </label>
          @else
            <div class="col-md-9">
              {{Form::select('stat', RequesterStat::$values, $requester->stat, ['class'=>'form-control'])}}
            </div>
          @endif
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">Name <span class="required">*</span></label>
          <div class="col-md-9">
            {{Form::text('name', $requester->name, ['class'=>'form-control', 'maxlength'=>50])}}
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Password
            @if($action == 'create')
              <span class="required">*</span>
            @endif
          </label>
          <div class="col-md-9">
            {{Form::password('password', ['class'=>'form-control'])}}
            <span class="help-block">Fill in password field only when you want to update the password</span>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">Designation</label>
          <div class="col-md-9">
            {{Form::text('designation', $requester->designation, ['class'=>'form-control', 'maxlength'=>30])}}
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">Office <span class="required">*</span></label>
          <div class="col-md-9">
            {{Form::select('office_id', $offices, $requester->office_id, ['id'=>'office_id', 'class'=>'form-control', 'placeholder'=>''])}}
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">Email <span class="required">*</span></label>
          <div class="col-md-9">
            {{Form::text('email', $requester->email, ['class'=>'form-control', 'maxlength'=>100])}}
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">Work</label>
          <div class="col-md-9">
            {{Form::text('work', $requester->work, ['class'=>'form-control', 'maxlength'=>30])}}
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">Mobile <span class="required">*</span></label>
          <div class="col-md-9">
            {{Form::text('mobile', $requester->mobile, ['class'=>'form-control', 'maxlength'=>30])}}
          </div>
        </div>
      </div>
      <div class="col-md-6">
        {{--<div class="form-group">
          <label class="control-label col-md-3">Preferred Contact</label>
          <div class="col-md-9">
            {{Form::select('preferred_contact', PreferredContact::$values, $requester->preferred_contact, ['class'=>'form-control', 'placeholder'=>''])}}
          </div>
        </div>--}}
      </div>
    </div>

    <div class="margin-top-30">
      <div class="align-center">
        <input type="submit" name="submit" value="SAVE" class="more active">
      </div>
    </div>

  </form>
@endsection