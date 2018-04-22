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
            <td width="120px">Contact</td>
            <td><a href="{{ url('admin/frontend/content/save/contact') }}">{!! str_limit($contents['contact'], 200) !!}</a></td>
          </tr>
          <tr>
            <td>Email</td>
            <td><a href="{{ url('admin/frontend/content/save/email') }}">{!! str_limit($contents['email'], 200) !!}</a></td>
          </tr>
          <tr>
            <td>Opening Hours</td>
            <td><a href="{{ url('admin/frontend/content/save/opening_hours') }}">{!! str_limit($contents['opening_hours'], 200) !!}</a></td>
          </tr>
          <tr>
            <td>Address</td>
            <td><a href="{{ url('admin/frontend/content/save/address') }}">{!! str_limit($contents['address'], 200) !!}</a></td>
          </tr>
          <tr>
            <td>Facebook</td>
            <td><a href="{{ url('admin/frontend/content/save/facebook') }}">{!! str_limit($contents['facebook'], 200) !!}</a></td>
          </tr>
        </table>
        
        <h4>Home - About section</h4>
        <table class="table table-bordered table-hover">
          <tr>
            <td width="120px"></td>
            <td>Icon</td>
            <td>Title</td>
            <td>Content</td>
          </tr>
          <tr>
            <td>Header</td>
            <td></td>
            <td><a href="{{ url('admin/frontend/content/save/about_title') }}">{!! str_limit($contents['about_title'], 200) !!}</a></td>
            <td><a href="{{ url('admin/frontend/content/save/about_content') }}">{!! str_limit($contents['about_content'], 200) !!}</a></td>
          </tr>
          <tr>
            <td>Column 1</td>
            <td><a href="{{ url('admin/frontend/content/save/about_column1_icon') }}">{!! str_limit($contents['about_column1_icon'], 200) !!}</a></td>
            <td><a href="{{ url('admin/frontend/content/save/about_column1_title') }}">{!! str_limit($contents['about_column1_title'], 200) !!}</a></td>
            <td><a href="{{ url('admin/frontend/content/save/about_column1_content') }}">{!! str_limit($contents['about_column1_content'], 200) !!}</a></td>
          </tr>
          <tr>
            <td>Column 2</td>
            <td><a href="{{ url('admin/frontend/content/save/about_column2_icon') }}">{!! str_limit($contents['about_column2_icon'], 200) !!}</a></td>
            <td><a href="{{ url('admin/frontend/content/save/about_column2_title') }}">{!! str_limit($contents['about_column2_title'], 200) !!}</a></td>
            <td><a href="{{ url('admin/frontend/content/save/about_column2_content') }}">{!! str_limit($contents['about_column2_content'], 200) !!}</a></td>
          </tr>
          <tr>
            <td>Column 3</td>
            <td><a href="{{ url('admin/frontend/content/save/about_column3_icon') }}">{!! str_limit($contents['about_column3_icon'], 200) !!}</a></td>
            <td><a href="{{ url('admin/frontend/content/save/about_column3_title') }}">{!! str_limit($contents['about_column3_title'], 200) !!}</a></td>
            <td><a href="{{ url('admin/frontend/content/save/about_column3_content') }}">{!! str_limit($contents['about_column3_content'], 200) !!}</a></td>
          </tr>
          <tr>
            <td>Column 4</td>
            <td><a href="{{ url('admin/frontend/content/save/about_column4_icon') }}">{!! str_limit($contents['about_column4_icon'], 200) !!}</a></td>
            <td><a href="{{ url('admin/frontend/content/save/about_column4_title') }}">{!! str_limit($contents['about_column4_title'], 200) !!}</a></td>
            <td><a href="{{ url('admin/frontend/content/save/about_column4_content') }}">{!! str_limit($contents['about_column4_content'], 200) !!}</a></td>
          </tr>
        </table>
        
        <h4>Home - Services section</h4>
        <table class="table table-bordered table-hover">
          <tr>
            <td width="120px">Title</td>
            <td><a href="{{ url('admin/frontend/content/save/service_title') }}">{!! str_limit($contents['service_title'], 200) !!}</a></td>
          </tr>
          <tr>
            <td>Content</td>
            <td><a href="{{ url('admin/frontend/content/save/service_content') }}">{!! str_limit($contents['service_content'], 200) !!}</a></td>
          </tr>
          <tr>
            <td>Column 1</td>
            <td><a href="{{ url('admin/frontend/content/save/service_column1_content') }}">{!! str_limit($contents['service_column1_content'], 200) !!}</a></td>
          </tr>
          <tr>
            <td>Column 2</td>
            <td><a href="{{ url('admin/frontend/content/save/service_column2_content') }}">{!! str_limit($contents['service_column2_content'], 200) !!}</a></td>
          </tr>
          <tr>
            <td>Column 3</td>
            <td><a href="{{ url('admin/frontend/content/save/service_column3_content') }}">{!! str_limit($contents['service_column3_content'], 200) !!}</a></td>
          </tr>
        </table>
        
        <h4>Membership page</h4>
        <table class="table table-bordered table-hover">
          <tr>
            <td width="120px">Content</td>
            <td><a href="{{ url('admin/frontend/content/save/membership_content') }}">{!! str_limit($contents['membership_content'], 200) !!}</a></td>
          </tr>
          <tr>
            <td>Detail</td>
            <td><a href="{{ url('admin/frontend/content/save/membership_detail') }}">{!! str_limit($contents['membership_detail'], 200) !!}</a></td>
          </tr>
          <tr>
            <td>Details PDF</td>
            <td><a href="{{ url('admin/frontend/file/save/membership_details') }}">Details PDF</a></td>
          </tr>
          <tr>
            <td>Cheque</td>
            <td><a href="{{ url('admin/frontend/content/save/payment_cheque') }}">{!! str_limit($contents['payment_cheque'], 200) !!}</a></td>
          </tr>
          <tr>
            <td>Bank Transfer</td>
            <td><a href="{{ url('admin/frontend/content/save/payment_banktransfer') }}">{!! str_limit($contents['payment_banktransfer'], 200) !!}</a></td>
          </tr>
          <tr>
            <td>NETS</td>
            <td><a href="{{ url('admin/frontend/content/save/payment_nets') }}">{!! str_limit($contents['payment_nets'], 200) !!}</a></td>
          </tr>
          <tr>
            <td>Credit Card</td>
            <td><a href="{{ url('admin/frontend/content/save/payment_creditcard') }}">{!! str_limit($contents['payment_creditcard'], 200) !!}</a></td>
          </tr>
          <tr>
            <td>Cash</td>
            <td><a href="{{ url('admin/frontend/content/save/payment_cash') }}">{!! str_limit($contents['payment_cash'], 200) !!}</a></td>
          </tr>
        </table>
        
        <h4>Members page</h4>
        <table class="table table-bordered table-hover">
          <tr>
            <td width="120px">Invite content</td>
            <td><a href="{{ url('admin/frontend/content/save/invite_content') }}">{!! str_limit($contents['invite_content'], 200) !!}</a></td>
          </tr>
        </table>
        
        <h4>About page</h4>
        <table class="table table-bordered table-hover">
          <tr>
            <td width="120px">Title</td>
            <td><a href="{{ url('admin/frontend/content/save/about_page_title') }}">{!! str_limit($contents['about_page_title'], 200) !!}</a></td>
          </tr>
          <tr>
            <td>Content</td>
            <td><a href="{{ url('admin/frontend/content/save/about_page_content') }}">{!! str_limit($contents['about_page_content'], 200) !!}</a></td>
          </tr>
          <tr>
            <td>Image</td>
            <td><a href="{{ url('admin/frontend/content/save/about_page_image') }}">{!! str_limit($contents['about_page_image'], 200) !!}</a></td>
          </tr>
          <tr>
            <td>Line 1</td>
            <td><a href="{{ url('admin/frontend/content/save/about_line1') }}">{!! str_limit($contents['about_line1'], 200) !!}</a></td>
          </tr>
          <tr>
            <td>Line 2</td>
            <td><a href="{{ url('admin/frontend/content/save/about_line2') }}">{!! str_limit($contents['about_line2'], 200) !!}</a></td>
          </tr>
          <tr>
            <td>Line 3</td>
            <td><a href="{{ url('admin/frontend/content/save/about_line3') }}">{!! str_limit($contents['about_line3'], 200) !!}</a></td>
          </tr>
          <tr>
            <td>Line 4</td>
            <td><a href="{{ url('admin/frontend/content/save/about_line4') }}">{!! str_limit($contents['about_line4'], 200) !!}</a></td>
          </tr>
          <tr>
            <td>Line 5</td>
            <td><a href="{{ url('admin/frontend/content/save/about_line5') }}">{!! str_limit($contents['about_line5'], 200) !!}</a></td>
          </tr>
        </table>
        
        <h4>Terms and conditions</h4>
        <table class="table table-bordered table-hover">
          <tr>
            <td width="120px">Terms and conditions</td>
            <td>
              <a href="{{ url('admin/frontend/content/save/terms_and_conditions') }}">
                {!! str_limit($contents['terms_and_conditions'], 200) !!}
              </a>
            </td>
          </tr>
        </table>
        
        <h4>Meta</h4>
        <table class="table table-bordered table-hover">
          <tr>
            <td width="160px">Home title</td>
            <td><a href="{{ url('admin/frontend/content/save/home_meta_title') }}">{!! str_limit($contents['home_meta_title'], 200) !!}</a></td>
          </tr>
          <tr>
            <td>Home keyword</td>
            <td><a href="{{ url('admin/frontend/content/save/home_keyword') }}">{!! str_limit($contents['home_keyword'], 200) !!}</a></td>
          </tr>
          <tr>
            <td>Home desc</td>
            <td><a href="{{ url('admin/frontend/content/save/home_desc') }}">{!! str_limit($contents['home_desc'], 200) !!}</a></td>
          </tr>
          <tr>
            <td width="90px">About title</td>
            <td><a href="{{ url('admin/frontend/content/save/about_meta_title') }}">{!! str_limit($contents['about_meta_title'], 200) !!}</a></td>
          </tr>
          <tr>
            <td>About keyword</td>
            <td><a href="{{ url('admin/frontend/content/save/about_keyword') }}">{!! str_limit($contents['about_keyword'], 200) !!}</a></td>
          </tr>
          <tr>
            <td>About desc</td>
            <td><a href="{{ url('admin/frontend/content/save/about_desc') }}">{!! str_limit($contents['about_desc'], 200) !!}</a></td>
          </tr>
          <tr>
            <td width="90px">Services title</td>
            <td><a href="{{ url('admin/frontend/content/save/service_meta_title') }}">{!! str_limit($contents['service_meta_title'], 200) !!}</a></td>
          </tr>
          <tr>
            <td>Services keyword</td>
            <td><a href="{{ url('admin/frontend/content/save/service_keyword') }}">{!! str_limit($contents['service_keyword'], 200) !!}</a></td>
          </tr>
          <tr>
            <td>Services desc</td>
            <td><a href="{{ url('admin/frontend/content/save/service_desc') }}">{!! str_limit($contents['service_desc'], 200) !!}</a></td>
          </tr>
          <tr>
            <td width="90px">Membership title</td>
            <td><a href="{{ url('admin/frontend/content/save/membership_meta_title') }}">{!! str_limit($contents['membership_meta_title'], 200) !!}</a></td>
          </tr>
          <tr>
            <td>Membership keyword</td>
            <td><a href="{{ url('admin/frontend/content/save/membership_keyword') }}">{!! str_limit($contents['membership_keyword'], 200) !!}</a></td>
          </tr>
          <tr>
            <td>Membership desc</td>
            <td><a href="{{ url('admin/frontend/content/save/membership_desc') }}">{!! str_limit($contents['membership_desc'], 200) !!}</a></td>
          </tr>
          <tr>
            <td width="90px">Contact title</td>
            <td><a href="{{ url('admin/frontend/content/save/contact_meta_title') }}">{!! str_limit($contents['contact_meta_title'], 200) !!}</a></td>
          </tr>
          <tr>
            <td>Contact keyword</td>
            <td><a href="{{ url('admin/frontend/content/save/contact_keyword') }}">{!! str_limit($contents['contact_keyword'], 200) !!}</a></td>
          </tr>
          <tr>
            <td>Contact desc</td>
            <td><a href="{{ url('admin/frontend/content/save/contact_desc') }}">{!! str_limit($contents['contact_desc'], 200) !!}</a></td>
          </tr>
        </table>
      
      
      </div>
    </div>
  </div>
@endsection