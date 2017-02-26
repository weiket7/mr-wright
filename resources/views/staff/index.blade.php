<?php use App\Models\Enums\CompanyStat; ?>

@extends("template", [ "title"=>"Companies" ])

@section("content")
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