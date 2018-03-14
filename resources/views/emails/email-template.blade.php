<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body style="font-family: Arial">
  <div>
    <img src="{{asset("assets/images/mr-wright-logo.png")}}" style="height: 40px; margin-top: 30px; margin-bottom: 20px;">
    <br><br>

    @yield('content')
    
    @if(! isset($hide_footer))
      <br><br><br>
      If you have any questions or encounter any issues, please email us at {{$frontend['contents']['email']}}.
      <br><br>
  
      Regards,<br>
      Mr Wright
    @endif
    </p>
  </div>
</body>
</html>