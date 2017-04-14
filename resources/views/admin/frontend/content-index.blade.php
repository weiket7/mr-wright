<?php use App\Models\Enums\CompanyStat; ?>

@extends("admin.template")

@section("content")
  <div class="row">
    <div class="col-md-6">
      <h1 class="page-title">Contents</h1>
    </div>
    <div class="col-md-6 text-right">
      <button type="button" class="btn blue" onclick="location.href='{{url('admin/content/save')}}'">Create</button>
    </div>
  </div>


  <div class="portlet light bordered">
    <div class="portlet-body">
      <div class="table-responsive">
        <h4>General</h4>
        <table class="table table-bordered table-hover">
          <tr>
            <td>Contact</td>
            <td>{{ $contents['contact'] }}</td>
          </tr>
          <tr>
            <td>Email</td>
            <td>{{ $contents['email'] }}</td>
          </tr>
          <tr>
            <td>Opening Hours</td>
            <td>{{ $contents['opening_hours'] }}</td>
          </tr>
          <tr>
            <td>Address</td>
            <td>{{ $contents['address'] }}</td>
          </tr>
          <tr>
            <td>Facebook</td>
            <td>{{ $contents['facebook'] }}</td>
          </tr>
        </table>

        <h4>About</h4>
        <table class="table table-bordered table-hover">
          <tr>
            <td></td>
            <td>Icon</td>
            <td>Title</td>
            <td>Content</td>
          </tr>
          <tr>
            <td>Column 1</td>
            <td>{{$contents['about_column1_icon']}}</td>
            <td>{{$contents['about_column1_title']}}</td>
            <td>{{$contents['about_column1_content']}}</td>
          </tr>
          <tr>
            <td>Column 2</td>
            <td>{{$contents['about_column2_icon']}}</td>
            <td>{{$contents['about_column2_title']}}</td>
            <td>{{$contents['about_column2_content']}}</td>
          </tr>
          <tr>
            <td>Column 3</td>
            <td>{{$contents['about_column3_icon']}}</td>
            <td>{{$contents['about_column3_title']}}</td>
            <td>{{$contents['about_column3_content']}}</td>
          </tr>
          <tr>
            <td>Column 4</td>
            <td>{{$contents['about_column4_icon']}}</td>
            <td>{{$contents['about_column4_title']}}</td>
            <td>{{$contents['about_column4_content']}}</td>
          </tr>
        </table>

        <h4>Service</h4>
        <table class="table table-bordered table-hover">
          <tr>
            <td></td>
            <td>Image</td>
            <td>Title</td>
            <td>Content</td>
          </tr>
          <tr>
            <td>Column 1</td>
            <td>{{$contents['service_column1_image']}}</td>
            <td>{{$contents['service_column1_title']}}</td>
            <td>{{$contents['service_column1_content']}}</td>
          </tr>
          <tr>
            <td>Column 2</td>
            <td>{{$contents['service_column2_image']}}</td>
            <td>{{$contents['service_column2_title']}}</td>
            <td>{{$contents['service_column2_content']}}</td>
          </tr>
          <tr>
            <td>Column 3</td>
            <td>{{$contents['service_column3_image']}}</td>
            <td>{{$contents['service_column3_title']}}</td>
            <td>{{$contents['service_column3_content']}}</td>
          </tr>
        </table>

      </div>
    </div>
  </div>
@endsection