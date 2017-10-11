@extends("admin.template")

@section("content")
  <div class="row">
    <div class="col-xs-6">
      <h1 class="page-title">Blocked Dates</h1>
    </div>
    <div class="col-xs-6 text-right">
      <button type="button" class="btn blue" onclick="location.href='{{url('admin/blocked-date/save')}}'">Create</button>
    </div>
  </div>

  <div class="portlet light bordered">
    <div class="portlet-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>Date</th>
          </tr>
          </thead>
          <tbody>
          @foreach($blocked_dates as $d)
            <tr>
              <td><a href="{{url('admin/blocked-date/save/'.$d->working_date_blocked_id)}}">{{ ViewHelper::formatDate($d->date) }}</a></td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection