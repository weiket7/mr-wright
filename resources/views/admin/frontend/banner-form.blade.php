@extends("admin.template")

@section('content')
  <h1 class="page-title">
    {{ $action }} Banner
  </h1>

  <div class="portlet light bordered">
    <div class="portlet-body form">
      <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
        {!! csrf_field() !!}
  
        <div class="form-group">
          <label class="control-label col-md-2">Title</label>
          <div class="col-md-10">
            {{Form::text('title', $banner->title, ['rows'=>'5', 'class'=>'form-control'])}}
          </div>
        </div>
  
        <div class="form-group">
          <label class="control-label col-md-2">Content</label>
          <div class="col-md-10">
            {{Form::textarea('content', $banner->content, ['rows'=>'5', 'class'=>'form-control'])}}
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-2">Button Text</label>
          <div class="col-md-10">
            {{Form::text('button_text', $banner->button_text, ['rows'=>'5', 'class'=>'form-control'])}}
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-2">Button Link</label>
          <div class="col-md-10">
            {{Form::text('link', $banner->link, ['rows'=>'5', 'class'=>'form-control'])}}
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-2">
            Image<br>
            <small>(max 1920px width x 600px height)</small>
          </label>
          <div class="col-md-10 form-control-static">
            <img src="{{asset('assets/images/frontend/banners/'.$banner->image)}}" style="max-height: 200px; max-width: 300px;">
            {{Form::file('image')}}
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