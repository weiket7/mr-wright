@extends("admin.template")

@section('content')
<h1 class="page-title">
  {{ucfirst($action)}} Blog
</h1>

<div class="portlet light bordered" id="app">
  <div class="portlet-body form">
    <form action="" method="post" class="form-horizontal">
      {!! csrf_field() !!}
      <input type="hidden" name="delete" id="delete">
      <div class="form-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label col-md-3">Title <span class="required">*</span></label>
              <div class="col-md-9">
                {{Form::text('title', $blog->title, ['class'=>'form-control', 'autofocus'])}}
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label col-md-3">Status</label>
              <div class="col-md-9">
                <div class="mt-radio-inline">
                  <label class="mt-radio mt-radio-outline">
                    {{Form::radio('stat', 1, $blog->stat == 1)}} Enabled
                    <span></span>
                  </label>
                  <label class="mt-radio mt-radio-outline">
                    {{Form::radio('stat', 0, $blog->stat == 0)}} Disabled
                    <span></span>
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label col-md-3">Meta Title</label>
              <div class="col-md-9">
                {{Form::text('meta_title', $blog->meta_title, ['class'=>'form-control'])}}
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label col-md-3">Meta Keyword</label>
              <div class="col-md-9">
                {{Form::text('meta_keyword', $blog->meta_keyword, ['class'=>'form-control'])}}
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label col-md-3">Meta Description</label>
              <div class="col-md-9">
                {{Form::text('meta_desc', $blog->meta_desc, ['class'=>'form-control'])}}
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label col-md-3">URL <span class="required">*</span></label>
              <div class="col-md-9">
                <input type="text" name="url" v-model="url" class="form-control">
                <span class="help-block">http://mrwright.sg/blog/<b>@{{ url }}</b> </span>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <textarea name="content" id="editor">
            {{ $blog->content }}
        </textarea>
      
      <div class="form-actions">
        <div class="row">
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-offset-3 col-md-9">
                <button type="submit" class="btn green">Submit</button>
                <button type="submit" class="btn red confirmation" data-toggle='confirmation'>Delete</button>
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

@section('script')
<script src="{{asset('assets/js/ckeditor.js')}}"></script>
<script>
  var vm = new Vue({
    el: "#app",
    data: {
      url: '{{$blog->url}}'
    },
  });
  
  ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .then( editor => {
      console.log( editor );
    }).catch( error => {
    console.error( error );
  });
</script>
@endsection