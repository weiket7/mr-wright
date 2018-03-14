<p>
  Company Name: {{$contact->company_name}}<br>
  Name: {{$contact->name}}<br>
  Email: {{$contact->email}}<br>
  Mobile: {{$contact->mobile}}<br>
  @if($contact->promo_code)
    Promo Code: {{$contact->promo_code}}<br>
  @endif
  Source: {{$contact->source}}<br>
  
  <br>
  {{$contact->message}}
</p>