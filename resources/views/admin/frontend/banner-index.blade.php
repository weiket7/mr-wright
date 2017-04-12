<?php use App\Models\Enums\CompanyStat; ?>

@extends("admin.template")

@section("content")
  <div class="row">
    <div class="col-md-6">
      <h1 class="page-title">Banners</h1>
    </div>
    <div class="col-md-6 text-right">
      <button type="button" class="btn blue" onclick="location.href='{{url('admin/banner/save')}}'">Create</button>
    </div>
  </div>


  <div class="portlet light bordered">
    <div class="portlet-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
          <tr>
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
              <td><a href="{{url("admin/banner/save/".$banner->frontend_banner_id)}}">{{ $banner->title }}</a></td>
              <td>{{ $banner->content }}</td>
              <td>{{ $banner->button_text }}</td>
              <td>{{ $banner->link }}</td>
              <td>{{ $banner->image }}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection