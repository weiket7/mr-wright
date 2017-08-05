@extends("admin.template")

@section('content')
  <h1 class="page-title">
    Update Content
  </h1>
  
  <div class="portlet light bordered">
    <div class="portlet-body form">
      <form action="" method="post" class="form-horizontal">
        {!! csrf_field() !!}
        <div class="form-group">
          <label class="control-label col-md-3">Key</label>
          <div class="col-md-9 form-control-static">
            {{ $key }}
          </div>
        </div>
        
        <div class="form-group">
          <label class="control-label col-md-3">Value</label>
          <div class="col-md-9">
            {{Form::textarea('value', $value, ['id'=>"txt-content", 'rows'=>'5', 'class'=>'form-control'])}}
          </div>
        </div>
        
        <div class="form-actions">
          <div class="row">
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-offset-3 col-md-9">
                  <button type="submit" class="btn green">Submit</button>
                  <button type="button" class="btn default">Cancel</button>
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

@section('css')
  <link href="{{asset('assets/metronic/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('script')
  <script src="{{asset('assets/metronic/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js')}}" type="text/javascript"></script>
  <script src="{{asset('assets/metronic/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}" type="text/javascript"></script>

  <script>
    $(document).ready(function() {
      $('#txt-content').wysihtml5({
        "stylesheets": ["../../../../assets/metronic/global/plugins/bootstrap-wysihtml5/wysiwyg-color.css"]
      });
    });
  </script>
@endsection