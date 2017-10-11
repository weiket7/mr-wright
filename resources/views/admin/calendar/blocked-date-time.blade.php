@extends("admin.template")

@section("content")
  <div class="row">
    <div class="col-xs-6">
      <h1 class="page-title">Blocked Date Times</h1>
    </div>
    <div class="col-xs-6 text-right">
      <button type="button" class="btn blue" onclick="location.href='{{url('admin/blocked-date-time/save')}}'">Create</button>
    </div>
  </div>

  <div class="portlet light bordered">
    <div class="portlet-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
          <tr>
            <th width="120px">Date</th>
            <th width="120px">Time Start</th>
            <th>Time End</th>
          </tr>
          </thead>
          <tbody>
          @foreach($blocked_date_times as $w)
            <tr>
              <td><a href="{{url('admin/blocked-date-time/save/'.$w->working_date_time_blocked_id)}}">{{ ViewHelper::formatDate($w->date) }}</a></td>
              <td>{{ ViewHelper::formatTime($w->time_start) }}</td>
              <td>{{ ViewHelper::formatTime($w->time_end) }}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection