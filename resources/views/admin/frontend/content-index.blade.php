<?php use App\Models\Enums\CompanyStat; ?>

@extends("admin.template")

@section("content")
<style>
  h4 {
    font-weight: 600;
  }
</style>
  
  <div class="row">
    <div class="col-md-12">
      <h1 class="page-title">Contents</h1>
    </div>
  </div>


  <div class="portlet light bordered">
    <div class="portlet-body">
      <div class="table-responsive">
        <h4><a href="{{url('assets\renovate\fonts\streamline-large\icons-reference.html')}}">Icons reference</a></h4>
        <br>
  
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
          <tr>
            <td>Favicon</td>
            <td><a href="{{ url('admin/frontend/content/save/favicon') }}">{{ $contents['favicon'] }}</a></td>
          </tr>
          
        </table>

        <h4>Home - About section</h4>
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

        <h4>Home - Services section</h4>
        <table class="table table-bordered table-hover">
          <tr>
            <td>Title</td>
            <td><a href="{{ url('admin/frontend/content/save/service_title') }}">{{$contents['service_title']}}</a></td>
          </tr>
          <tr>
            <td>Content</td>
            <td><a href="{{ url('admin/frontend/content/save/service_content') }}">{{$contents['service_content']}}</a></td>
          </tr>
          <tr>
            <td>Column 1</td>
            <td><a href="{{ url('admin/frontend/content/save/service_column1_content') }}">{{$contents['service_column1_content']}}</a></td>
          </tr>
          <tr>
            <td>Column 2</td>
            <td><a href="{{ url('admin/frontend/content/save/service_column2_content') }}">{{$contents['service_column2_content']}}</a></td>
          </tr>
          <tr>
            <td>Column 3</td>
            <td><a href="{{ url('admin/frontend/content/save/service_column3_content') }}">{{$contents['service_column3_content']}}</a></td>
          </tr>
        </table>
        
        <h4>Membership page</h4>
        <table class="table table-bordered table-hover">
          <tr>
            <td>Membership content</td>
            <td><a href="{{ url('admin/frontend/content/save/membership_content') }}">{{$contents['membership_content']}}</a></td>
          </tr>
        </table>
  
        <h4>Members page</h4>
        <table class="table table-bordered table-hover">
          <tr>
            <td>Invite content</td>
            <td><a href="{{ url('admin/frontend/content/save/invite_content') }}">{{$contents['invite_content']}}</a></td>
          </tr>
        </table>
        
        <h4>About page</h4>
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
            <td>Image</td>
            <td><a href="{{ url('admin/frontend/content/save/about_page_image') }}">{{$contents['about_page_image']}}</a></td>
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
  
        <h4>Meta</h4>
        <table class="table table-bordered table-hover">
          <tr>
            <td width="160px">Home title</td>
            <td><a href="{{ url('admin/frontend/content/save/home_meta_title') }}">{{$contents['home_meta_title']}}</a></td>
          </tr>
          <tr>
            <td>Home keyword</td>
            <td><a href="{{ url('admin/frontend/content/save/home_keyword') }}">{{$contents['home_keyword']}}</a></td>
          </tr>
          <tr>
            <td>Home desc</td>
            <td><a href="{{ url('admin/frontend/content/save/home_desc') }}">{{$contents['home_desc']}}</a></td>
          </tr>
          <tr>
            <td width="90px">About title</td>
            <td><a href="{{ url('admin/frontend/content/save/about_meta_title') }}">{{$contents['about_meta_title']}}</a></td>
          </tr>
          <tr>
            <td>About keyword</td>
            <td><a href="{{ url('admin/frontend/content/save/about_keyword') }}">{{$contents['about_keyword']}}</a></td>
          </tr>
          <tr>
            <td>About desc</td>
            <td><a href="{{ url('admin/frontend/content/save/about_desc') }}">{{$contents['about_desc']}}</a></td>
          </tr>
          <tr>
            <td width="90px">Services title</td>
            <td><a href="{{ url('admin/frontend/content/save/service_meta_title') }}">{{$contents['service_meta_title']}}</a></td>
          </tr>
          <tr>
            <td>Services keyword</td>
            <td><a href="{{ url('admin/frontend/content/save/service_keyword') }}">{{$contents['service_keyword']}}</a></td>
          </tr>
          <tr>
            <td>Services desc</td>
            <td><a href="{{ url('admin/frontend/content/save/service_desc') }}">{{$contents['service_desc']}}</a></td>
          </tr>
          <tr>
            <td width="90px">Membership title</td>
            <td><a href="{{ url('admin/frontend/content/save/membership_meta_title') }}">{{$contents['membership_meta_title']}}</a></td>
          </tr>
          <tr>
            <td>Membership keyword</td>
            <td><a href="{{ url('admin/frontend/content/save/membership_keyword') }}">{{$contents['membership_keyword']}}</a></td>
          </tr>
          <tr>
            <td>Membership desc</td>
            <td><a href="{{ url('admin/frontend/content/save/membership_desc') }}">{{$contents['membership_desc']}}</a></td>
          </tr>
          <tr>
            <td width="90px">Contact title</td>
            <td><a href="{{ url('admin/frontend/content/save/contact_meta_title') }}">{{$contents['contact_meta_title']}}</a></td>
          </tr>
          <tr>
            <td>Contact keyword</td>
            <td><a href="{{ url('admin/frontend/content/save/contact_keyword') }}">{{$contents['contact_keyword']}}</a></td>
          </tr>
          <tr>
            <td>Contact desc</td>
            <td><a href="{{ url('admin/frontend/content/save/contact_desc') }}">{{$contents['contact_desc']}}</a></td>
          </tr>
        </table>
        

      </div>
    </div>
  </div>
@endsection