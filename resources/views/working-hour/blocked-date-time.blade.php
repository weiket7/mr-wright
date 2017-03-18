@extends("template")

@section("content")
  <div class="row">
    <div class="col-md-12">
      <h1 class="page-title">Blocked Date Times</h1>
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
              <td>{{ ViewHelper::formatDate($w->date) }}</td>
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