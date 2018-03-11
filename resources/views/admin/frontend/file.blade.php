@extends("admin.template")

@section('content')
  <h1 class="page-title">
    Upload File
  </h1>
  
  <div class="portlet light bordered">
    <div class="portlet-body form">
      <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <div class="form-group">
          <label class="control-label col-md-3">
            File
          </label>
          <div class="col-md-9 form-control-static">
            <a href="{{asset('assets/'.$frontend_file->file_name) }}">{{ $frontend_file->key }}</a>
          </div>
        </div>
        
        <div class="form-group">
          <label class="control-label col-md-3">
            Upload
          </label>
          <div class="col-md-9">
            <input type="file" name="value">
          </div>
        </div>
        
        <div class="form-actions">
          <div class="row">
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-offset-3 col-md-9">
                  <button type="submit" class="btn green">Submit</button>
                  <button type="button" class="btn default" onclick="location.href='{{url('admin/frontend/content')}}'">Cancel</button>
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
