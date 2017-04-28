@extends('frontend.template', ['title'=>'Register Existing UEN'])

@section('content')

  <form method="post" action="">
    {{ csrf_field() }}

    <div class="alert alert-info">
      The Unity Entity Number (UEN) has been registered.<br>
      If you wish to proceed, the company's admin will be informed to approve or reject your registration and inform you via mobile and/or email.
    </div>

    <div class="margin-top-30">
      <div class="align-center">
        <input type="submit" name="submit" value="PROCEED" class="more active">
      </div>
    </div>

  </form>
@endsection