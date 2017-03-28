<?php use App\Models\Enums\ProductStat; ?>

@extends("template")

@section('content')
  <h1 class="page-title">
    {{ucfirst($action)}} Role
  </h1>

  <div class="portlet light bordered">
    <div class="portlet-body form">
      <form action="" method="post" class="form-horizontal">
        {!! csrf_field() !!}
        <div class="form-body">
          <div class="form-group">
            <label class="control-label col-md-2">Name</label>
            <div class="col-md-10">
              <div class="form-control-static">{{ $role }}</div>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">Accesses</label>
            <div class="col-md-10">
              <table class="table table-bordered no-margin-btm">
                @foreach($accesses as $a)
                  <tr>
                    <td>{{ $a->name }}</td>
                  </tr>
                @endforeach
              </table>
            </div>
          </div>
        </div>
        <div class="form-actions">
          <div class="row">
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-offset-3 col-md-9">
                  <button type="submit" class="btn green">Submit</button>
                  <button type="button" class="btn default">Cancel</button>
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