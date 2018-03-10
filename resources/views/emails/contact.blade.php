<p>
  Company Name: {{$contact->company_name}}<br>
  Name: {{$contact->name}}<br>
  Email: {{$contact->email}}<br>
  Mobile: {{$contact->mobile}}<br>
  @if($contact->promo_code)
    Promo Code: {{$contact->promo_code}}<br>
  @endif
  
  <br>
  {{$contact->message}}
</p>