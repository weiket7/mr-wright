@extends("template")

@section("content")
  <div class="row">
    <div class="col-md-6">
      <h1 class="page-title">
        Categories for Ticket
      </h1>
    </div>
    <div class="col-md-6 text-right">
      <button type="button" class="btn blue" onclick="location.href='{{url('category/save')}}'">Create</button>
    </div>
  </div>

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
            <th>Name</th>
          </tr>
          </thead>
          <tbody>
          @foreach($categories as $id => $name)
            <tr>
              <td><a href="{{url("category/save/".$id)}}">{{ $name }}</a></td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection