@extends('frontend.template', ['title'=>'forgot password'])

@section('content')
  <form method="post" action="" class="form-horizontal">
    {{csrf_field()}}
    
    <p class="">
      Please enter your email and a new password will be emailed to you.
      <br><br>
  
      If you have questions or encounter any issues, please email us at {{$frontend['contents']['email']}}.
    </p>
    <br>
  
    <div class="form-group">
      <div class="control-label col-md-2">
        Email
      </div>
      <div class="col-md-9">
        {{Form::email('email', '', ['class'=>'form-control', 'autofocus'])}}
        
      </div>
    </div>
  
    <div class="text-center">
      <input type="submit" name="submit" value="SUBMIT" class="more active">
    </div>
  </form>
@endsection