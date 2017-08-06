<?php use App\Models\Menu; ?>

  <!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
Version: 4.7.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
  <meta charset="utf-8" />
  <title>Mr Wright v1.0</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <meta content="Preview page of Metronic Admin Theme #2 for blank page layout" name="description" />
  <meta content="" name="author" />
  <!-- BEGIN GLOBAL MANDATORY STYLES -->
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
  <link href="{{asset('assets/metronic/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('assets/metronic/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('assets/metronic/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('assets/metronic/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
  <!-- END GLOBAL MANDATORY STYLES -->
  <!-- BEGIN PAGE LEVEL PLUGINS -->
  <link href="{{asset('assets/metronic/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('assets/metronic/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('assets/metronic/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('assets/metronic/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('assets/metronic/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('assets/metronic/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('assets/metronic/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
  <!-- END PAGE LEVEL PLUGINS -->
  <!-- BEGIN THEME GLOBAL STYLES -->
  <link href="{{asset('assets/metronic/global/css/components.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
  <link href="{{asset('assets/metronic/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
  <!-- END THEME GLOBAL STYLES -->
  <!-- BEGIN THEME LAYOUT STYLES -->
  <link href="{{asset('assets/metronic/layouts/layout2/css/layout.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('assets/metronic/layouts/layout2/css/themes/blue.min.css')}}" rel="stylesheet" type="text/css" id="style_color" />
  @section('css')
  @show
  <link href="{{asset('assets/metronic/layouts/layout2/css/custom.css')}}" rel="stylesheet" type="text/css" />
  <!-- END THEME LAYOUT STYLES -->
  
  <link rel="shortcut icon" href="{{asset('favicon.png')}}">
</head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
  <!-- BEGIN HEADER INNER -->
  <div class="page-header-inner ">
    <!-- BEGIN LOGO -->
    <div class="page-logo">
      <a href="{{url('admin')}}">
        <img src="{{asset('assets/images/mr-wright-logo2.png')}}" style="max-height: 14px;" alt="logo" class="logo-default" /> </a>
      <div class="menu-toggler sidebar-toggler">
        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
      </div>
    </div>
    <!-- END LOGO -->
    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
    <!-- END RESPONSIVE MENU TOGGLER -->
    <!-- BEGIN PAGE ACTIONS -->
    <!-- DOC: Remove "hide" class to enable the page header actions -->
    <div class="page-actions">
      <div class="btn-group">
        <button type="button" class="btn btn-circle btn-outline red" onclick="location.href='{{url('admin/ticket/save')}}'">
          <i class="fa fa-plus"></i>&nbsp;
          <span class="hidden-sm hidden-xs">Create Ticket&nbsp;</span>&nbsp;
        </button>
      </div>
    </div>
    <!-- END PAGE ACTIONS -->
    <!-- BEGIN PAGE TOP -->
    <div class="page-top">
      <!-- BEGIN HEADER SEARCH BOX -->
      <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
      <form class="search-form search-form-expanded" action="page_general_search_3.html" method="GET">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search..." name="query">
          <span class="input-group-btn">
                                <a href="javascript:;" class="btn submit">
                                    <i class="icon-magnifier"></i>
                                </a>
                            </span>
        </div>
      </form>
      <!-- END HEADER SEARCH BOX -->
      <!-- BEGIN TOP NAVIGATION MENU -->
      <div class="top-menu">
        <ul class="nav navbar-nav pull-right">
          <!-- BEGIN NOTIFICATION DROPDOWN -->
          <!-- DOC: Apply "dropdown-dark" class below "dropdown-extended" to change the dropdown styte -->
          <!-- DOC: Apply "dropdown-hoverable" class after below "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
          <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->
          <!-- BEGIN USER LOGIN DROPDOWN -->
          <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
          <li class="dropdown dropdown-user">
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
              <span class="username username-hide-on-mobile"> {{ Auth::user()->username }} </span>
              <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-default">

              <li>
                <a href="{{url('admin/logout')}}">
                  <i class="icon-key"></i> Log Out </a>
              </li>
            </ul>
          </li>
          <!-- END USER LOGIN DROPDOWN -->
        </ul>
      </div>
      <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END PAGE TOP -->
  </div>
  <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container">
  <!-- BEGIN SIDEBAR -->
  <div class="page-sidebar-wrapper">
    <!-- END SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
      <!-- BEGIN SIDEBAR MENU -->
      <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
      <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
      <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
      <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
      <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
      <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->

      <ul class="page-sidebar-menu page-header-fixed page-sidebar-menu-hover-submenu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
        <?php $menu = Menu::getMenu(Auth::user()->type); ?>
        @foreach($menu as $m)
          <li class="nav-item">
            <?php $link = isset($m['link']) ? url($m['link']) : "javascript:;"; ?>
            <a href="{{ $link }}" class="nav-link nav-toggle">
              <i class="{{ $m['icon'] }}"></i>
              <span class="title">{{$m['name']}}</span>
            </a>
            @if(! isset($m['link']))
            <ul class="sub-menu">
              @foreach($m['sub'] as $s)
                <li class="nav-item">
                  <a href="{{url($s['link'])}}" class="nav-link">
                    <span class="title">{{$s['name']}}</span>
                  </a>
                </li>
              @endforeach
            </ul>
            @endif
          </li>
        @endforeach
      </ul>
      <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
  </div>
  <!-- END SIDEBAR -->
  <!-- BEGIN CONTENT -->
  <div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
      @yield('content')
    </div>
    <!-- END CONTENT BODY -->
  </div>
  <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
  <div class="page-footer-inner"> {{ date('Y') }} &copy; Mr Wright
    <div class="scroll-to-top">
      <i class="icon-arrow-up"></i>
    </div>
  </div>
  <!-- END FOOTER -->
</div>
  <!-- END QUICK NAV -->
  <!--[if lt IE 9]>
  <script src="{{asset('assets/metronic/global/plugins/respond.min.js')}}"></script>
  <script src="{{asset('assets/metronic/global/plugins/excanvas.min.js')}}"></script>
  <script src="{{asset('assets/metronic/global/plugins/ie8.fix.min.js')}}"></script>
  <![endif]-->
  <!-- BEGIN CORE PLUGINS -->
  <script src="{{asset('assets/metronic/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('assets/js/jquery-ui.min.js')}}" type="text/javascript"></script>

  <script src="{{asset('assets/metronic/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('assets/metronic/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('assets/metronic/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('assets/metronic/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('assets/metronic/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
  <!-- END CORE PLUGINS -->
  <!-- BEGIN PAGE LEVEL PLUGINS -->
  <script src="{{asset('assets/metronic/global/plugins/moment.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('assets/metronic/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('assets/metronic/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('assets/metronic/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js')}}" type="text/javascript"></script>
  <script src="{{asset('assets/metronic/global/plugins/bootstrap-toastr/toastr.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('assets/metronic/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
  <!-- END PAGE LEVEL PLUGINS -->
  <!-- BEGIN THEME GLOBAL SCRIPTS -->
  <script src="{{asset('assets/metronic/global/scripts/app.min.js')}}" type="text/javascript"></script>
  <!-- END THEME GLOBAL SCRIPTS -->
  <!-- BEGIN THEME LAYOUT SCRIPTS -->
  <script src="{{asset('assets/metronic/layouts/layout2/scripts/layout.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('assets/metronic/layouts/layout2/scripts/demo.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('assets/metronic/layouts/global/scripts/quick-sidebar.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('assets/metronic/layouts/global/scripts/quick-nav.min.js')}}" type="text/javascript"></script>
  <!-- END THEME LAYOUT SCRIPTS -->
  <script src="{{asset('assets/js/vue.js')}}" type="text/javascript"></script>
  <script src="{{asset('assets/js/common.js')}}" type="text/javascript"></script>
  <script src="{{asset('assets/js/axios.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('assets/js/lodash.min.js')}}" type="text/javascript"></script>

  <script>
    $(document).ready(function() {
      toastr.options.positionClass = "toast-top-center";
      toastr.options.preventDuplicates = true;
      //https://github.com/CodeSeven/toastr/issues/166
      toastr.options.timeOut = 0;
      toastr.options.extendedTimeOut = 0;

      $.fn.select2.defaults.set("theme", "bootstrap");

      initDatepicker();

      $("#company_id").change(function() {
        var company_id = $(this).val();
        axios.get('{{url('api/getOfficeByCompany')}}?company_id='+company_id)
        .then(function (response) {
          var offices = response.data;
          var html = '<option></option>';
          for (var office_id in offices) {
            if (offices.hasOwnProperty(office_id)) {
              html += "<option value="+office_id+">" + offices[office_id] + "</option>";
            }
          }
          $("#office_id").html(html);
        })
        .catch(function (error) {
          console.log('company_id change error='+error);
        })
      });

      $("#office_id").change(function() {
        var office_id = $(this).val();
        axios.get('{{url('api/getRequesterByOffice')}}?office_id='+office_id)
        .then(function (response) {
          var requesters = response.data;
          var html = '<option></option>';
          for (var requester_id in requesters) {
            if (requesters.hasOwnProperty(requester_id)) {
              html += "<option value="+requester_id+">" + requesters[requester_id] + "</option>";
            }
          }
          $("#requested_by").html(html);
        })
        .catch(function (error) {
          console.log('office_id change error='+error);
        });

        axios.get('{{url('api/getOffice')}}?office_id='+office_id)
        .then(function (response) {
          var office = response.data;
          $("#office_addr").html(office.addr);
          $("#office_postal").html(office.postal);
        })
        .catch(function (error) {
          console.log('office_id change error='+error);
        })
      });

      @if(Session::has('msg'))
        toastr.info("{{Session::get('msg')}}");
      @elseif(isset($search_result))
        toastr.info("{{$search_result}}");
      @endif
  
      @if ($errors->any())
        var error = '';
        @foreach ($errors->all() as $error)
          error += '{!! $error !!}<br>';
        @endforeach
        toastr.error(error);
      @endif
    });
    
    function initDatepicker() {
      $(".datepicker").datepicker({
        format: "dd M yyyy",
        orientation: "bottom",
        autoclose: true
      });
    }
  </script>

  @section('script')

  @show
</body>

</html>