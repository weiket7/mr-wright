@extends("admin.template")

@section("content")
  <div class="row">
    <div class="col-xs-6">
      <h1 class="page-title">
        Skills
      </h1>
    </div>
    <div class="col-xs-6 text-right">
      <button type="button" class="btn blue" onclick="location.href='{{url('admin/skill/save')}}'">Create</button>
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
            <th width="200px  ">Name</th>
            <th>Description</th>
          </tr>
          </thead>
          <tbody>
          @foreach($skills as $skill)
            <tr>
              <td><a href="{{url("admin/skill/save/".$skill->skill_id)}}">{{ $skill->name }}</a></td>
              <td>{{ $skill->desc }}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection