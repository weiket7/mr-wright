@extends("emails.email-template", ['hide_footer'=>true])

@section('content')
  
  <p>Name: {{$contact->name}}<br>
    Email: {{$contact->email}}<br>
    Mobile: {{$contact->mobile}}<br>
    <br>
    {{$contact->message}}
  </p>

@endsection