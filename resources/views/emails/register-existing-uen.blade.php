@extends("emails.email-template")

@section('content')
  <blockquote>Registration using {{$requester->company_name}}'s UEN</blockquote>

  Hi {{$requester->name}},
  <br><br>

  As you are the admin of {{ $requester->company_name }}, we would like to inform you that someone registered using your company's UEN {{$registration->uen}} and the following details:
  <br><br>

  <div class="div-registration">
    <div class="row">
      <div class="col-xs-6">
        <div class="row">
          <div class="col-xs-3">
            Name
          </div>
          <div class="col-xs-9">
            {{ $registration->name }}
          </div>
        </div>
      </div>
      <div class="col-xs-6">
        <div class="row">
          <div class="col-xs-3">
            Designation
          </div>
          <div class="col-xs-9">
            {{ $registration->designation }}
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-6">
        <div class="row">
          <div class="col-xs-3">
            Mobile
          </div>
          <div class="col-xs-9">
            {{ $registration->mobile }}
          </div>
        </div>
      </div>
      <div class="col-xs-6">
        <div class="row">
          <div class="col-xs-3">
            Email
          </div>
          <div class="col-xs-9">
            {{ $registration->email }}
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-6">
        <div class="row">
          <div class="col-xs-3">
            Company Name
          </div>
          <div class="col-xs-9">
            {{ $registration->company_name }}
          </div>
        </div>
      </div>
      <div class="col-xs-6">
        <div class="row">
          <div class="col-xs-3">
            UEN
          </div>
          <div class="col-xs-9">
            {{ $registration->uen }}
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-6">
        <div class="row">
          <div class="col-xs-3">
            Address
          </div>
          <div class="col-xs-9">
            {{ $registration->addr }}
          </div>
        </div>
      </div>
      <div class="col-xs-6">
        <div class="row">
          <div class="col-xs-3">
            Postal
          </div>
          <div class="col-xs-9">
            {{ $registration->postal }}
          </div>
        </div>
      </div>
    </div>
  </div>

  <hr>

  If you approve this registration, he/she will be added under your company's membership plan.
  <br><br>

  Please log in to approve or decline this registration.
  
  <br><br>
  <a href="{{url('login?referral=invite/registration/'.$registration->registration_id)}}" class="btn btn-primary">Log In</a>
@endsection