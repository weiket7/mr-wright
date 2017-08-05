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
            <td><a href="{{ url('admin/frontend/content/save/contact') }}">{{ $contents['contact'] }}</a></td>
          </tr>
          <tr>
            <td>Email</td>
            <td><a href="{{ url('admin/frontend/content/save/email') }}">{{ $contents['email'] }}</a></td>
          </tr>
          <tr>
            <td>Opening Hours</td>
            <td><a href="{{ url('admin/frontend/content/save/opening_hours') }}">{{ $contents['opening_hours'] }}</a></td>
          </tr>
          <tr>
            <td>Address</td>
            <td><a href="{{ url('admin/frontend/content/save/address') }}">{{ $contents['address'] }}</a></td>
          </tr>
          <tr>
            <td>Facebook</td>
            <td><a href="{{ url('admin/frontend/content/save/facebook') }}">{{ $contents['facebook'] }}</a></td>
          </tr>
        </table>

        <h4>Home - About</h4>
        <table class="table table-bordered table-hover">
          <tr>
            <td width="90px"></td>
            <td>Icon</td>
            <td>Title</td>
            <td>Content</td>
          </tr>
          <tr>
            <td>Header</td>
            <td></td>
            <td><a href="{{ url('admin/frontend/content/save/about_title') }}">{{$contents['about_title']}}</a></td>
            <td><a href="{{ url('admin/frontend/content/save/about_content') }}">{{$contents['about_content']}}</a></td>
          </tr>
          <tr>
            <td>Column 1</td>
            <td><a href="{{ url('admin/frontend/content/save/about_column1_icon') }}">{{$contents['about_column1_icon']}}</a></td>
            <td><a href="{{ url('admin/frontend/content/save/about_column1_title') }}">{{$contents['about_column1_title']}}</a></td>
            <td><a href="{{ url('admin/frontend/content/save/about_column1_content') }}">{{$contents['about_column1_content']}}</a></td>
          </tr>
          <tr>
            <td>Column 2</td>
            <td><a href="{{ url('admin/frontend/content/save/about_column2_icon') }}">{{$contents['about_column2_icon']}}</a></td>
            <td><a href="{{ url('admin/frontend/content/save/about_column2_title') }}">{{$contents['about_column2_title']}}</a></td>
            <td><a href="{{ url('admin/frontend/content/save/about_column2_content') }}">{{$contents['about_column2_content']}}</a></td>
          </tr>
          <tr>
            <td>Column 3</td>
            <td><a href="{{ url('admin/frontend/content/save/about_column3_icon') }}">{{$contents['about_column3_icon']}}</a></td>
            <td><a href="{{ url('admin/frontend/content/save/about_column3_title') }}">{{$contents['about_column3_title']}}</a></td>
            <td><a href="{{ url('admin/frontend/content/save/about_column3_content') }}">{{$contents['about_column3_content']}}</a></td>
          </tr>
          <tr>
            <td>Column 4</td>
            <td><a href="{{ url('admin/frontend/content/save/about_column4_icon') }}">{{$contents['about_column4_icon']}}</a></td>
            <td><a href="{{ url('admin/frontend/content/save/about_column4_title') }}">{{$contents['about_column4_title']}}</a></td>
            <td><a href="{{ url('admin/frontend/content/save/about_column4_content') }}">{{$contents['about_column4_content']}}</a></td>
          </tr>
        </table>

        <h4>Home - Services</h4>
        <table class="table table-bordered table-hover">
          <tr>
            <td></td>
            <td>Image</td>
            <td>Title</td>
            <td>Content</td>
          </tr>
          <tr>
            <td>Header</td>
            <td></td>
            <td><a href="{{ url('admin/frontend/content/save/service_title') }}">{{$contents['service_title']}}</a></td>
            <td><a href="{{ url('admin/frontend/content/save/service_content') }}">{{$contents['service_content']}}</a></td>
          </tr>
          <tr>
            <td>Column 1</td>
            <td><a href="{{ url('admin/frontend/content/save/service_column1_image') }}">{{$contents['service_column1_image']}}</a></td>
            <td><a href="{{ url('admin/frontend/content/save/service_column1_title') }}">{{$contents['service_column1_title']}}</a></td>
            <td><a href="{{ url('admin/frontend/content/save/service_column1_content') }}">{{$contents['service_column1_content']}}</a></td>
          </tr>
          <tr>
            <td>Column 2</td>
            <td><a href="{{ url('admin/frontend/content/save/service_column2_image') }}">{{$contents['service_column2_image']}}</a></td>
            <td><a href="{{ url('admin/frontend/content/save/service_column2_title') }}">{{$contents['service_column2_title']}}</a></td>
            <td><a href="{{ url('admin/frontend/content/save/service_column2_content') }}">{{$contents['service_column2_content']}}</a></td>
          </tr>
          <tr>
            <td>Column 3</td>
            <td><a href="{{ url('admin/frontend/content/save/service_column3_image') }}">{{$contents['service_column3_image']}}</a></td>
            <td><a href="{{ url('admin/frontend/content/save/service_column3_title') }}">{{$contents['service_column3_title']}}</a></td>
            <td><a href="{{ url('admin/frontend/content/save/service_column3_content') }}">{{$contents['service_column3_content']}}</a></td>
          </tr>
        </table>
  
        <h4>About Page</h4>
        <table class="table table-bordered table-hover">
          <tr>
            <td width="90px">Title</td>
            <td><a href="{{ url('admin/frontend/content/save/about_page_title') }}">{{$contents['about_page_title']}}</a></td>
          </tr>
          <tr>
            <td>Content</td>
            <td><a href="{{ url('admin/frontend/content/save/about_page_content') }}">{{$contents['about_page_content']}}</a></td>
          </tr>
          <tr>
            <td>Line 1</td>
            <td><a href="{{ url('admin/frontend/content/save/about_line1') }}">{{$contents['about_line1']}}</a></td>
          </tr>
          <tr>
            <td>Line 2</td>
            <td><a href="{{ url('admin/frontend/content/save/about_line2') }}">{{$contents['about_line2']}}</a></td>
          </tr>
          <tr>
            <td>Line 3</td>
            <td><a href="{{ url('admin/frontend/content/save/about_line3') }}">{{$contents['about_line3']}}</a></td>
          </tr>
          <tr>
            <td>Line 4</td>
            <td><a href="{{ url('admin/frontend/content/save/about_line4') }}">{{$contents['about_line4']}}</a></td>
          </tr>
          <tr>
            <td>Line 5</td>
            <td><a href="{{ url('admin/frontend/content/save/about_line5') }}">{{$contents['about_line5']}}</a></td>
          </tr>
        </table>

      </div>
    </div>
  </div>
@endsection