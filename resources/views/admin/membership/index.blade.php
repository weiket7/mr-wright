@extends("admin.template")

@section("content")
  <div class="row">
    <div class="col-md-6">
      <h1 class="page-title">Memberships</h1>
    </div>
    <div class="col-md-6 text-right">
      <button type="button" class="btn blue" onclick="location.href='{{url('admin/membership/save')}}'">Create</button>
    </div>
  </div>
  
  <div class="portlet light bordered">
    <div class="portlet-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
          <tr>
            <th width="70px">Status</th>
            <th>Name</th>
            <th>Number of Requesters</th>
            <th>Price</th>
          </tr>
          </thead>
          <tbody>
          @foreach($memberships as $membership)
            <tr>
              <td>{{\App\Models\Enums\MembershipStat::$values[$membership->stat]}}</td>
              <td><a href="{{url("admin/membership/save/".$membership->membership_id)}}">{{ $membership->name }}</a></td>
              <td>{{ $membership->requester_limit }}</td>
              <td>{{ ViewHelper::formatCurrency($membership->effective_price) }}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection