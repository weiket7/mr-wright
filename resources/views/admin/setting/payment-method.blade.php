@extends("admin.template")

@section("content")
  <div class="row">
    <div class="col-md-6">
      <h1 class="page-title">Payment Methods</h1>
    </div>
  </div>
  
  <div class="portlet light bordered">
    <div class="portlet-body">
      <form method="post" action="">
        {{ csrf_field() }}
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead>
            <tr>
              <th width="70px">Position</th>
              <th width="120px">Status</th>
              <th>Name</th>
            </tr>
            </thead>
            <tbody>
            @foreach($payment_methods as $pm)
              <tr>
                <td><input type="text" name="position{{$pm->payment_method_id}}" class="form-control txt-num" value="{{$pm->position}}" readonly></td>
                <td>{{ Form::select("stat".$pm->payment_method_id, \App\Models\Enums\PaymentMethodStat::$values, $pm->stat, ['class'=>'form-control']) }}</td>
                <td><a href="{{url("admin/payment-method/save/".$pm->payment_method_id)}}">{{ $pm->name }}</a></td>
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