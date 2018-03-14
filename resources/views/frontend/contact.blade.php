@extends('frontend.template', [
  'title'=>'contact us',
  'meta_title'=>$frontend['contents']['contact_meta_title'],
  'meta_keyword'=>$frontend['contents']['contact_keyword'],
  'meta_desc'=>$frontend['contents']['contact_desc']
])

@section('content')
  @if(session()->has('sent'))
    <div class="alert alert-success">
      Thank you for your message, we will get back to you shortly.
    </div>
  @endif
  
  <div id="app">
    <form method="post" action="{{url('contact')}}" class="margin-top-40 contact-form">
      {{ csrf_field() }}
      <input type="hidden" name="source" value="Contact Us">

      <div class="r-row">
        <fieldset class="column column-1-2">
          <input class="text-input hint" name="company_name" type="text" placeholder="Company Name *" maxlength="50" autofocus>
          <input class="text-input hint" name="name" type="text" placeholder="Name *" maxlength="50" required="required">
          <input class="text-input hint" name="email" type="email" placeholder="Email *" maxlength="100" required="required">
          <input class="text-input hint" name="mobile" type="text" placeholder="Mobile *" maxlength="30" required="required">
          <input class="text-input hint" name="promo_code" type="text" placeholder="Promo Code" maxlength="30">
        </fieldset>
        <fieldset class="column column-1-2">
          <textarea name="message" placeholder="Message *" class="hint" style="height:330px" maxlength="250" required="required"></textarea>
        </fieldset>
      </div>
      <div class="r-row margin-top-30">
        <div class="align-center">
          <input type="submit" name="submit" value="SEND" class="more active">
        </div>
      </div>
    </form>
  </div>
@endsection