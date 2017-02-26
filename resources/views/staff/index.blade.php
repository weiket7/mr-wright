<?php use App\Models\Enums\StaffStat; ?>

@extends("template")

@section("content")
  <div class="row">
    <div class="col-md-6">
      <h1 class="page-title">
        Staffs
      </h1>
    </div>
    <div class="col-md-6 text-right">
      <button type="button" class="btn blue" onclick="location.href='{{url('staff/save')}}'">Create</button>
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
            <th width="50px">Status</th>
            <th>Name</th>
          </tr>
          </thead>
          <tbody>
          @foreach($staffs as $staff)
            <tr>
              <td>{{StaffStat::$values[$staff->stat]}}</td>
              <td width="450px"><a href="{{url("staff/save/".$staff->staff_id)}}">{{ $staff->name }}</a></td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection