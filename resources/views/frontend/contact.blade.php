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
  
  <form method="post" action="" class="margin-top-40 contact-form">
    {{ csrf_field() }}
    <div class="r-row">
      <fieldset class="column column-1-2">
        <input class="text-input hint" name="name" type="text" placeholder="Name *">
        <input class="text-input hint" name="email" type="email" placeholder="Email *">
        <input class="text-input hint" name="mobile" type="text" placeholder="Mobile *">
      </fieldset>
      <fieldset class="column column-1-2">
        <textarea name="message" placeholder="Message *" class="hint"></textarea>
      </fieldset>
    </div>
    <div class="r-row margin-top-30">
      <div class="align-center">
        <input type="submit" name="submit" value="SEND" class="more active">
      </div>
    </div>
  </form>
@endsection