<?php use App\Models\Enums\CompanyStat; ?>

@extends("admin.template")

@section("content")
  <div class="row">
    <div class="col-md-6">
      <h1 class="page-title">Banners</h1>
    </div>
  </div>


  <div class="portlet light bordered">
    <div class="portlet-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>Position</th>
            <th>Title</th>
            <th>Content</th>
            <th>Button Text</th>
            <th>Button Link</th>
            <th>Image</th>
          </tr>
          </thead>
          <tbody>
          @foreach($banners as $banner)
            <tr>
              <td><input type="text" class="form-control txt-num-short" value="{{$banner->position}}"></td>
              <td><a href="{{url("admin/banner/save/".$banner->frontend_banner_id)}}">{{ $banner->title }}</a></td>
              <td>{{ $banner->content }}</td>
              <td>{{ $banner->button_text }}</td>
              <td>{{ $banner->link }}</td>
              <td><img src="{{ asset('images/frontend/services/'.$banner->image) }}" style="max-height: 200px; max-width: 300px;">
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection