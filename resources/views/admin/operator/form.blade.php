<?php use App\Models\Enums\UserStat; ?>

@extends("admin.template")

@section('content')
  <h1 class="page-title">
    {{ucfirst($action)}} Operator
  </h1>

  <div class="portlet light bordered">
    <div class="portlet-body form">
      <form action="" method="post" class="form-horizontal">
        {!! csrf_field() !!}
        <input type="hidden" name="delete" id="delete">
  
        <div class="form-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Username <span class="required">*</span></label>
                <div class="col-md-9">
                  @if($action == 'update')
                    <div class="form-control-static">{{ $operator->username }}</div>
                  @else
                    {{Form::text('username', $operator->username, ['class'=>'form-control', 'maxlength'=>20])}}
                  @endif
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Status</label>
                <div class="col-md-9">
                  {{Form::select('stat', UserStat::$values, $operator->stat, ['class'=>'form-control'])}}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Name <span class="required">*</span></label>
                <div class="col-md-9">
                  {{Form::text('name', $operator->name, ['class'=>'form-control', 'maxlength'=>50])}}
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
                <label class="control-label col-md-3">Email <span class="required">*</span></label>
                <div class="col-md-9">
                  {{Form::text('email', $operator->email, ['class'=>'form-control', 'maxlength'=>100])}}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Role <span class="required">*</span></label>
                <div class="col-md-9">
                  {{Form::select('role_id', $roles, $operator->role_id, ['class'=>'form-control', 'placeholder'=>''])}}
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="form-actions">
          <div class="row">
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-offset-3 col-md-9">
                  <button type="submit" class="btn green">Submit</button>
                  <button type="submit" class="btn red confirmation" data-toggle='confirmation'>Delete</button>
                  <button type="button" onclick="location.href='{{url('admin/operator')}}'" class="btn default">Back to List</button>

                </div>
              </div>
            </div>
            <div class="col-md-6"> </div>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection