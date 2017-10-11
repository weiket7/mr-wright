<?php use App\Models\Enums\ProductStat; ?>

@extends("admin.template")

@section('content')
  <h1 class="page-title">
    {{ucfirst($action)}} Category for Ticket
  </h1>
  
  <div class="portlet light bordered">
    <div class="portlet-body form">
      <form action="" method="post" class="form-horizontal">
        {!! csrf_field() !!}
        <div class="form-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Name</label>
                <div class="col-md-9">
                  {{Form::text('name', $category->name, ['class'=>'form-control'])}}
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="form-actions">
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-offset-3 col-md-9">
                  <button type="submit" class="btn green">Submit</button>
                  <button type="button" class="btn default">Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection