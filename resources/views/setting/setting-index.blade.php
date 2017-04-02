@extends("template")

@section("content")
  <div class="row">
    <div class="col-md-6">
      <h1 class="page-title">Settings</h1>
    </div>
    <div class="col-md-6 text-right">
    </div>
  </div>

  <div class="portlet light bordered">
    <div class="portlet-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
          <tr>
            <th width="300px">Name</th>
            <th>Value</th>
          </tr>
          </thead>
          <tbody>
          @foreach($settings as $setting)
            <tr>
              <td>{{ $setting->name }}</td>
              <td>{{ $setting->value }}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection