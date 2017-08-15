@extends("admin.template")

@section("content")
  <div class="row">
    <div class="col-xs-6">
      <h1 class="page-title">Memberships</h1>
    </div>
    <div class="col-xs-6 text-right">
      <button type="button" class="btn blue" onclick="location.href='{{url('admin/membership/save')}}'">Create</button>
    </div>
  </div>
  
  <div class="portlet light bordered">
    <div class="portlet-body">
      <form method="post" action="">
        {{ csrf_field() }}
        <div class="alert alert-info">
          Drag and drop the rows to rearrange
        </div>
        
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead>
            <tr>
              <th width="70px">Position</th>
              <th width="70px">Status</th>
              <th>Name</th>
              <th>Number of Requesters</th>
              <th>Price</th>
              <th>Free Trial</th>
            </tr>
            </thead>
            <tbody>
            @foreach($memberships as $membership)
              <tr>
                <td><input type="text" name="position{{$membership->membership_id}}" class="form-control txt-num" value="{{$membership->position}}" readonly></td>
                <td>{{\App\Models\Enums\MembershipStat::$values[$membership->stat]}}</td>
                <td><a href="{{url("admin/membership/save/".$membership->membership_id)}}">{{ $membership->name }}</a></td>
                <td>{{ $membership->requester_limit }}</td>
                <td>{{ ViewHelper::formatCurrency($membership->effective_price) }}</td>
                <td>{{ $membership->free_trial ? "Yes" : "No" }}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        
        <div class="row">
          <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-success">Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection

@section('script')
  <script>
    $(document).ready(function() {
      $("tbody").sortable({
        stop: function(event, ui) {
          var i = 1;
          $('tbody > tr').each(function() {
            $(this).find("input[type='text']").val(i);
            i++;
          });
        },
      });
    });
  </script>
@endsection