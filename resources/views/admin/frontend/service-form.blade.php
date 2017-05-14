@extends("admin.template")

@section('content')
  <h1 class="page-title">
    {{ ucfirst($action) }} Service
  </h1>
  
  <div class="portlet light bordered">
    <div class="portlet-body form">
      <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
        {!! csrf_field() !!}
        
        <div class="form-group">
          <label class="control-label col-md-2">Title</label>
          <div class="col-md-10">
            {{Form::text('title', $service->title, ['class'=>'form-control', 'maxlength'=>100])}}
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-2">Content</label>
          <div class="col-md-10">
            {{Form::textarea('content', $service->content, ['rows'=>'7', 'class'=>'form-control', 'maxlength'=>1000])}}
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-2">Meta Keyword</label>
          <div class="col-md-10">
            {{Form::textarea('meta_keyword', $service->meta_keyword, ['rows'=>'2', 'class'=>'form-control', 'maxlength'=>1000])}}
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-2">Meta Desc</label>
          <div class="col-md-10">
            {{Form::textarea('meta_desc', $service->meta_desc, ['rows'=>'3', 'class'=>'form-control', 'maxlength'=>1000])}}
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-2">
            Image 1<br>
            <small>(max 480px width x 320px height)</small>
          </label>
          <div class="col-md-10">
            <img src="{{asset('assets/images/frontend/services/'.$service->image1)}}" style="max-height: 200px; max-width: 300px;">
            {{Form::file('image1')}}
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-2">
            Image 2<br>
            <small>(max 480px width x 320px height)</small>
          </label>
          <div class="col-md-10">
            <img src="{{asset('assets/images/frontend/services/'.$service->image2)}}" style="max-height: 200px; max-width: 300px;">
            {{Form::file('image2')}}
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