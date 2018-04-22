@extends("admin.template")

@section('content')
  <h1 class="page-title">
    Update Content
  </h1>
  
  <div class="portlet light bordered">
    <div class="portlet-body form">
      <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <div class="form-group">
          <label class="control-label col-md-3">Key</label>
          <div class="col-md-9 form-control-static">
            {{ $key }}
          </div>
        </div>
        
        <div class="form-group">
          <label class="control-label col-md-3">
            Value
            @if($content->is_image)
              <br><small>{{ $content->dimension }}</small>
            @endif
          </label>
          <div class="col-md-9">
            @if($content->is_image)
              <input type="file" name="value">
              <img src="{{ url('assets/images/frontend/'.$content->value) }}" style="max-height: 200px">
            @else
              @if($content->plain)
                {{Form::textarea('value', $content->value, ['rows'=>20, 'class'=>'form-control'])}}
              @else
                {{Form::textarea('value', $content->value, ['id'=>"txt-content", 'rows'=>'20', 'class'=>'form-control'])}}
              @endif
            @endif
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
        "stylesheets": ["{{asset('assets/metronic/global/plugins/bootstrap-wysihtml5/wysiwyg-color.css')}}"]
      });
    });
  </script>
@endsection