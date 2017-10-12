@extends("admin.template")

@section('content')
  <h1 class="page-title">
    {{ucfirst($action)}} Skill
  </h1>

  <div class="portlet light bordered">
    <div class="portlet-body form">
      <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <input type="hidden" name="delete" id="delete">
        <div class="form-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Name</label>
                <div class="col-md-9">
                  {{Form::text('name', $skill->name, ['class'=>'form-control'])}}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Description</label>
                <div class="col-md-9">
                  {{Form::textarea('desc', $skill->desc, ['class'=>'form-control'])}}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">
                  Image<br>
                </label>
                <div class="col-md-9">
                  @if(strlen($skill->image) > 0)
                    <img src="{{asset("assets/images/".$skill->image)}}" class='thumbnail' style="max-height:200px;"/>
                  @endif
                  <input type='file' name='image'>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="form-actions">
          <div class="row">
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-offset-3 col-md-9">
                  <button type="submit" class="btn green">Submit</button>
                  <button type="submit" class="btn red confirmation" data-toggle='confirmation' data-title="{{$skill->name}} will be removed from all staffs. Are you sure? ">Delete</button>
                  <button type="button" onclick="location.href='{{url('admin/skill')}}'" class="btn default">Back to List</button>
                </div>
              </div>
            </div>
            <div class="col-md-6"> </div>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection