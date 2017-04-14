@extends('frontend.template')

@section('content')
  <div class="row page-margin-top">

    <h3 class="box-header">Contact</h3>

    <form method="post" action="" class="margin-top-40 margin-bottom-40 contact-form">
      {{ csrf_field() }}
      <div class="row">
        <fieldset class="column column-1-2">
          <input class="text-input hint" name="name" type="text" value="Your Name *" placeholder="Your Name *" autofocus>
          <input class="text-input hint" name="email" type="text" value="Your Email *" placeholder="Your Email *">
          <input class="text-input hint" name="phone" type="text" value="Your Phone" placeholder="Your Phone">
        </fieldset>
        <fieldset class="column column-1-2">
          <textarea name="message" placeholder="Message *" class="hint">Message *</textarea>
        </fieldset>
      </div>
      <div class="row margin-top-30">
        <div class="align-center">
          <input type="submit" name="submit" value="SEND MESSAGE" class="more active">
        </div>
      </div>
    </form>
  </div>
@endsection