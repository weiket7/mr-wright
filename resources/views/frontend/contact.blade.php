@extends('frontend.template', ['title'=>'contact us'])

@section('content')
  <form method="post" action="" class="margin-top-40 contact-form">
    {{ csrf_field() }}
    <div class="r-row">
      <fieldset class="column column-1-2">
        <input class="text-input hint" name="name" type="text" value="Your Name *" placeholder="Your Name *" autofocus>
        <input class="text-input hint" name="email" type="text" value="Your Email *" placeholder="Your Email *">
        <input class="text-input hint" name="phone" type="text" value="Your Phone" placeholder="Your Phone">
      </fieldset>
      <fieldset class="column column-1-2">
        <textarea name="message" placeholder="Message *" class="hint">Message *</textarea>
      </fieldset>
    </div>
    <div class="r-row margin-top-30">
      <div class="align-center">
        <input type="submit" name="submit" value="SEND MESSAGE" class="more active">
      </div>
    </div>
  </form>
@endsection