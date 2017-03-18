@extends("template")

@section("content")
  <div class="row">
    <div class="col-md-12">
      <h1 class="page-title">Blocked Dates</h1>
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
              <td>{{ ViewHelper::formatDate($d->date) }}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection