<?php use App\Models\Enums\CompanyStat; ?>

@extends("admin.template")

@section("content")
  <div class="row">
    <div class="col-md-6">
      <h1 class="page-title">Services</h1>
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
            <th>Image 1</th>
            <th>Image 2</th>
          </tr>
          </thead>
          <tbody>
          @foreach($services as $service)
            <tr>
              <td>{{ $service->position }}</td>
              <td><a href="{{url("admin/frontend/service/save/".$service->frontend_service_id)}}">{{ $service->title }}</a></td>
              <td>{!! str_limit($service->content, 200) !!}</td>
              <td><img src="{{ asset('assets/images/frontend/services/'.$service->image1) }}" style="max-height: 200px; max-width: 300px;">
              <td><img src="{{ asset('assets/images/frontend/services/'.$service->image2) }}" style="max-height: 200px; max-width: 300px;">
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection