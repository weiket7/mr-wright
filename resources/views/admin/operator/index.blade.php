<?php use App\Models\Enums\UserStat; ?>

@extends("admin.template", [ "title"=>"Companies" ])

@section("content")
  <div class="row">
    <div class="col-xs-6">
      <h1 class="page-title">Operators</h1>
    </div>
    <div class="col-xs-6 text-right">
      <button type="button" class="btn blue" onclick="location.href='{{url('admin/operator/save')}}'">Create</button>
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
            <th width="200px">Name</th>
            <th>Role</th>
          </tr>
          </thead>
          <tbody>
          @foreach($operators as $operator)
            <tr>
              <td>{{UserStat::$values[$operator->stat]}}</td>
              <td><a href="{{url("admin/operator/save/".$operator->user_id)}}">{{ $operator->name }}</a></td>
              <td>{{$roles[$operator->role_id]}}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection