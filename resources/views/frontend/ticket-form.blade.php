<?php use App\Models\Enums\TicketStat; ?>
<?php use App\Models\Enums\TicketUrgency; ?>
<?php use Carbon\Carbon; ?>

@extends('frontend.template')

@section('content')
  <div class="r-row gray full-width page-header vertical-align-table">
    <div class="r-row full-width padding-top-bottom-50 vertical-align-cell">
      <div class="r-row">
        <div class="page-header-left">
          <h1>CREATE TICKET</h1>
        </div>
      </div>
    </div>
  </div>

  <div class="r-row margin-bottom-40">
    <form method="post" action="" class="margin-top-40 form-horizontal">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Category
            </label>
            <div class="col-md-9">
              {{ Form::select('category', $categories, '', ['placeholder'=>'', 'class'=>'form-control']) }}
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Urgency
            </label>
            <div class="col-md-9">
              {{Form::select('urgency', TicketUrgency::$values, '', ['placeholder'=>'', 'class'=>'form-control'])}}
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Requested By
            </label>
            <label class="col-md-9 form-control-static">
              Jessie on {{ ViewHelper::formatDateTime(Carbon::now()) }}
            </label>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Description
            </label>
            <div class="col-md-9">
              {{Form::text('urgency', '', ['rows'=>3, 'class'=>'form-control'])}}
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
@endsection