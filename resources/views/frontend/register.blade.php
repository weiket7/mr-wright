@extends('frontend.template')

@section('content')

  <div class="row page-margin-top">

    <h3 class="box-header">REGISTER</h3>

    <form class="margin-top-40">
      <input class="text-input hint" name="name" type="text" placeholder="Your Name *">

    </form>


    <form class="comment-form margin-top-40" id="comment-form" method="post" action="/Renovate/Template/?page=post">
      <div class="row">
        <fieldset class="column column-1-2">
          <input class="text-input hint" name="name" type="text" value="Your Name *" placeholder="Your Name *">
          <input class="text-input hint" name="email" type="text" value="Your Email *" placeholder="Your Email *">
          <input class="text-input hint" name="website" type="text" value="Your Website" placeholder="Your Website">
        </fieldset>
        <fieldset class="column column-1-2">
          <textarea name="message" placeholder="Comment *" class="hint">Comment *</textarea>
        </fieldset>
      </div>
    </form>
  </div>

@endsection