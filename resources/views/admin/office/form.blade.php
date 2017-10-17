<?php use App\Models\Enums\OfficeStat; ?>

@extends("admin.template")

@section('content')
  <h1 class="page-title">
    {{ucfirst($action)}} Office
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
                <label class="control-label col-md-3">Name <span class="required">*</span></label>
                <div class="col-md-9">
                  {{Form::text('name', $office->name, ['class'=>'form-control', 'maxlength'=>50])}}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Status</label>
                <div class="col-md-9">
                  {{Form::select('stat', OfficeStat::$values, $office->stat, ['class'=>'form-control'])}}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Address <span class="required">*</span></label>
                <div class="col-md-9">
                  {{Form::textarea('addr', $office->addr, ['class'=>'form-control', 'rows'=>3, 'maxlength'=>200])}}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Postal <span class="required">*</span></label>
                <div class="col-md-9">
                  {{Form::text('postal', $office->postal, ['class'=>'form-control', 'maxlength'=>20])}}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Company <span class="required">*</span></label>
                <div class="col-md-9">
                  {{Form::select('company_id', $companies, $office->company_id, ['class'=>'form-control', 'placeholder'=>''])}}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3"></label>
                <div class="col-md-9">

                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="form-actions">
          <div class="row">
            <div class="col-md-offset-3 col-md-9">
              <button type="submit" class="btn green">Submit</button>
              <button type="submit" class="btn red confirmation" data-toggle='confirmation' data-title="All requesters under this office will be deleted also. Are you sure?">Delete</button>
              <button type="button" onclick="location.href='{{url('admin/office')}}'" class="btn default">Back to List</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection