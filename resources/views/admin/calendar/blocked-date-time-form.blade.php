<?php use App\Models\Enums\ProductStat; ?>

@extends("admin.template")

@section('content')
  <h1 class="page-title">
    {{ucfirst($action)}} Blocked Date Time
  </h1>
  
  <div class="portlet light bordered" id="app">
    <div class="portlet-body form">
      <form action="" method="post" class="form-horizontal">
        {!! csrf_field() !!}
        <input type="hidden" id="delete" name="delete" value="">
        <div class="form-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Date</label>
                <div class="col-md-9">
                  {{Form::text('date', ViewHelper::formatDate($blocked_date_time->date), ['class'=>'form-control datepicker'])}}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">From</label>
                <div class="col-md-9">
                  <dropdown-time :name="'time_start'" :value="time_start" class="select-time"></dropdown-time>
                </div>
              </div>
            </div>
          </div><div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">To</label>
                <div class="col-md-9">
                  <dropdown-time :name="'time_end'" :value="time_end" class="select-time"></dropdown-time>
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
                  <button type="button" onclick="location.href='{{url('admin/blocked-date-time')}}'" class="btn default">Back to List</button>
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

@section('script')
  <script src="{{asset('assets/js/ticket.js')}}" type="text/javascript"></script>
  
  <script>
    var vm = new Vue({
      el: "#app",
      data: {
        time_start: "{{ViewHelper::formatTimeValue($blocked_date_time->time_start)}}",
        time_end: "{{ViewHelper::formatTimeValue($blocked_date_time->time_end)}}"
      }
    });
  </script>
@endsection