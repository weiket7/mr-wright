
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
          @foreach($operators as $operator)
            <tr>
              <td width="450px"><a href="{{url("operator/save/".$operator->user_id)}}">{{ $operator->name }}</a></td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection