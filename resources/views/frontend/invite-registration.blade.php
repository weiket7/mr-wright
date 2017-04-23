@extends("frontend.template", ['title'=>'invite registration'])

@section('content')
  <form method="post" action="" class="margin-top-40">
    {{csrf_field()}}

    <div class="r-row">

      <div class="div-registration">
        <div class="row">
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-3">
                Name
              </div>
              <div class="col-md-9">
                {{ $registration->name }}
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-3">
                Designation
              </div>
              <div class="col-md-9">
                {{ $registration->designation }}
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-3">
                Mobile
              </div>
              <div class="col-md-9">
                {{ $registration->mobile }}
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-3">
                Email
              </div>
              <div class="col-md-9">
                {{ $registration->email }}
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-3">
                Company Name
              </div>
              <div class="col-md-9">
                {{ $registration->company_name }}
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-3">
                UEN
              </div>
              <div class="col-md-9">
                {{ $registration->uen }}
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-3">
                Address
              </div>
              <div class="col-md-9">
                {{ $registration->addr }}
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-3">
                Postal
              </div>
              <div class="col-md-9">
                {{ $registration->postal }}
              </div>
            </div>
          </div>
        </div>
      </div>

      <hr>

      If you approve this registration, he/she will be added under your company's membership plan.
      <br><br>

      <div class="text-center">
        <input type="submit" name="submit" value="APPROVE" class="more active">
        <input type="submit" name="submit" value="DECLINE" class="more active">
      </div>
    </div>

  </form>

@endsection