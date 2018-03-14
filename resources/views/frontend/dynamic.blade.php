@extends("frontend.template", [
  'title'=>$dynamic->title,
  'meta_title'=>$dynamic->meta_title,
  'meta_keyword'=>$dynamic->meta_keyword,
  'meta_desc'=>$dynamic->meta_desc,
  'google_analytics'=>$dynamic->google_analytics
])

@section('content')
  <style>
    .txtError {
      border-color: red;
    }
  </style>

  <div class="description about-content">
    {!! $dynamic->content !!}
  </div>
  
  @if($dynamic->has_contact)
    @if(session()->has('sent'))
      <div class="alert alert-success">
        Thank you for your message, we will get back to you shortly.
      </div>
    @endif
    
    <div id="app">
      <form method="post" action="{{url('contact')}}" class="margin-top-40 contact-form">
        {{ csrf_field() }}
        <input type="hidden" name="source" value="{{$dynamic->title}}">
        
        <div class="r-row">
          <fieldset class="column column-1-2">
            <input class="text-input hint" name="company_name" type="text" placeholder="Company Name *" maxlength="50" autofocus>
            <input class="text-input hint" name="name" type="text" placeholder="Name *" maxlength="50" required="required">
            <input class="text-input hint" name="email" type="email" placeholder="Email *" maxlength="100" required="required">
            <input class="text-input hint" name="mobile" type="text" placeholder="Mobile *" maxlength="30" required="required">
          </fieldset>
          <fieldset class="column column-1-2">
            <textarea name="message" placeholder="Message *" class="hint" style="height:260px" maxlength="250" required="required"></textarea>
          </fieldset>
        </div>
        <div class="r-row margin-top-30">
          <div class="align-center">
            <input type="submit" name="submit" value="SEND" class="more active">
          </div>
        </div>
      </form>
    </div>
  @endif
@endsection

@section('script')
@endsection