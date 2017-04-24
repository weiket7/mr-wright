@extends("admin.template")

@section("content")
  <div class="row">
    <div class="col-md-6">
      <h1 class="page-title">Registrations</h1>
    </div>
  </div>

  <div class="portlet light bordered">
    <div class="portlet-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>Status</th>
            <th>Name</th>
            <th>Username</th>
            <th>Designation</th>
            <th>Company Name</th>
            <th>Membership Plan</th>
            <th>Registered On</th>
          </tr>
          </thead>
          <tbody>
          @foreach($registrations as $registration)
            <tr>
              <td>
                @if($registration->approved)
                  <span class="label label-primary"> Approved </span>
                @else
                  <span class="label label-warning"> Pending </span>
                @endif
              </td>
              <td><a href="{{url("admin/registration/save/".$registration->registration_id)}}">{{ $registration->name }}</a></td>
              <td>{{ $registration->username }}</td>
              <td>{{ $registration->designation }}</td>
              <td>{{ $registration->company_name }}</td>
              <td>{{ $registration->membership_name }}</td>
              <td>{{ ViewHelper::formatDateTime($registration->created_on) }}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection