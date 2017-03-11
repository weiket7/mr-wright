<?php use App\Models\Enums\UserStat; ?>

@extends("template", [ "title"=>"Companies" ])

@section("content")
  <div class="row">
    <div class="col-md-6">
      <h1 class="page-title">Operators</h1>
    </div>
    <div class="col-md-6 text-right">
      <button type="button" class="btn blue" onclick="location.href='{{url('ticket/save')}}'">Create</button>
    </div>
  </div>

  <div class="portlet light bordered">
    <div class="portlet-body">
      @if(Session::has('search_result'))
        <div class="alert alert-success ">
          {{ Session::get('search_result') }}
        </div>
      @endif

      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
          <tr>
            <th width="70px">Status</th>
            <th>Name</th>
          </tr>
          </thead>
          <tbody>
          @foreach($operators as $operator)
            <tr>
              <td>{{UserStat::$values[$operator->stat]}}</td>
              <td><a href="{{url("operator/save/".$operator->user_id)}}">{{ $operator->name }}</a></td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection