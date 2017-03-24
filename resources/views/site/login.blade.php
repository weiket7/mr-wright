<?php $role = Request::segment(1) ?>

  <!DOCTYPE html>
<!-- saved from url=(0076)http://www.keenthemes.com/preview/metronic/theme/templates/admin2/login.html -->
<html lang="en"><!--<![endif]--><!-- BEGIN HEAD --><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <title>United Points - <?php echo ucfirst($role) ?> Login</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <meta content="" name="description">
  <meta content="" name="author">
  <!-- BEGIN GLOBAL MANDATORY STYLES -->
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
  <link href="{!! asset("assets/metronic/global/plugins/bootstrap/css/bootstrap.min.css") !!}" rel="stylesheet" />
  <!-- END GLOBAL MANDATORY STYLES -->
  <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->

  <!-- END PAGE LEVEL PLUGIN STYLES -->
  <!-- BEGIN PAGE STYLES -->
  <link href="{!! asset("assets/metronic/pages/css/login.min.css") !!}" rel="stylesheet" />
  <!-- END PAGE STYLES -->
  <!-- BEGIN THEME STYLES -->
  <!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
  <link href="{!! asset("assets/metronic/global/css/components.css") !!}" rel="stylesheet" />
  <link href="{!! asset("assets/metronic/global/css/plugins.css") !!}" rel="stylesheet" />
  <link href="{!! asset("assets/metronic/layouts/layout2/css/custom.css") !!}" rel="stylesheet" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
  <img src="{!! asset('images/mr-wright-logo.png') !!}" class="login-logo" alt="">
</div>
<!-- END LOGO -->

<div class="content">
  {!! Form::open(array()) !!}
  <h3 class="form-title font-green">Log In</h3>
  @if(Session::has('msg'))
    <div class="alert alert-danger ">
      {{ Session::get('msg') }}
    </div>
  @endif

  <div class="form-group">
    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
    <label class="control-label visible-ie8 visible-ie9">Username</label>
    <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username"
    @if(App::environment('local')) value='admin' @endif>
  </div>
  <div class="form-group">
    <label class="control-label visible-ie8 visible-ie9">Password</label>
    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"
    @if(App::environment('local')) value='123456' @endif>
  </div>
  <div class="form-actions">
    <button type="submit" class="btn btn-success uppercase">Login</button>
    <!--<label class="rememberme check">
      <div class="checker"><span><input type="checkbox" name="remember" value="1"></span></div>Remember </label>-->
    @if($role !== 'admin')
      <a href="{!! URL::to($role . '/account/reset-password') !!}" id="forget-password" class="forget-password">Reset Password</a>
    @endif
  </div>

  </form>
</div>

<div class="copyright">
  Mr Wright
</div>

</body></html>