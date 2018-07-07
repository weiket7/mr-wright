@extends("admin.template")

@section('content')
  <h1 class="page-title">
    {{ucfirst($action)}} Dynamic
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
                  {{Form::text('title', $dynamic->title, ['class'=>'form-control', 'autofocus'])}}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Status</label>
                <div class="col-md-9">
                  <div class="mt-radio-inline">
                    <label class="mt-radio mt-radio-outline">
                      {{Form::radio('stat', 1, $dynamic->stat == 1)}} Enabled
                      <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">
                      {{Form::radio('stat', 0, $dynamic->stat == 0)}} Disabled
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
                  {{Form::text('meta_title', $dynamic->meta_title, ['class'=>'form-control'])}}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Meta Keyword</label>
                <div class="col-md-9">
                  {{Form::text('meta_keyword', $dynamic->meta_keyword, ['class'=>'form-control'])}}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Meta Description</label>
                <div class="col-md-9">
                  {{Form::text('meta_desc', $dynamic->meta_desc, ['class'=>'form-control'])}}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Has Contact Form</label>
                <div class="col-md-9">
                  <div class="mt-radio-inline">
                    <label class="mt-radio mt-radio-outline">
                      {{Form::radio('has_contact', 1, $dynamic->has_contact == 1)}} Yes
                      <span></span>
                    </label>
                    <label class="mt-radio mt-radio-outline">
                      {{Form::radio('has_contact', 0, $dynamic->has_contact == 0)}} No
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
                <label class="control-label col-md-3">URL <span class="required">*</span></label>
                <div class="col-md-9">
                  <input type="text" name="url" v-model="url" class="form-control">
                  <span class="help-block">http://mrwright.sg/d/<b>@{{ url }}</b> </span>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <textarea name="content" id="editor">
            {{ $dynamic->content }}
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
  <script src="http://cdn.ckeditor.com/4.5.10/standard-all/ckeditor.js"></script>
  <script src="{{ url('assets/ckfinder/ckfinder.js')}}"></script>
  
  <script>
    var vm = new Vue({
      el: "#app",
      data: {
        url: '{{$dynamic->url}}'
      },
    });

    if ( typeof CKEDITOR !== 'undefined' ) {
      CKEDITOR.addCss( 'img {max-width:100%; height: auto;}' );
      var editor = CKEDITOR.replace( 'editor', {
        extraPlugins: 'uploadimage,image2',
        removePlugins: 'image',
        height:350
      } );
      CKFinder.setupCKEditor( editor );
    } else {
      document.getElementById( 'editor' ).innerHTML = '<div class="tip-a tip-a-alert">This sample requires working Internet connection to load CKEditor from CDN.</div>'
    }
  </script>
@endsection