@extends("frontend.template", ['title'=>$registration->stat == \App\Models\Enums\RegistrationStat::Pending ? 'pending' : 'approved' . ' registration'])

@section('content')
  <form method="post" action="" class="form-horizontal">
    {{csrf_field()}}

    <div class="row">
      <div class="col-md-6">
        <div class="row">
          <label class="col-md-3 control-label">
            Username
          </label>
          <label class="col-md-9 form-control-static">
            {{ $registration->username }}
          </label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row">
          <label class="col-md-3 control-label">
            Status
          </label>
          <label class="col-md-9 form-control-static">
            {{ \App\Models\Enums\RegistrationStat::$values[$registration->stat] }}
          </label>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="row">
          <label class="col-md-3 control-label">
            Name
          </label>
          <label class="col-md-9 form-control-static">
            {{ $registration->name }}
          </label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row">
          <label class="col-md-3 control-label">
            Designation
          </label>
          <label class="col-md-9 form-control-static">
            {{ $registration->designation }}
          </label>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="row">
          <label class="col-md-3 control-label">
            Mobile
          </label>
          <label class="col-md-9 form-control-static">
            {{ $registration->mobile }}
          </label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row">
          <label class="col-md-3 control-label">
            Email
          </label>
          <label class="col-md-9 form-control-static">
            {{ $registration->email }}
          </label>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="row">
          <label class="col-md-3 control-label">
            Office Name
          </label>
          @if($registration->stat == \App\Models\Enums\RegistrationStat::Pending)
            <div class="col-md-9">
              {{ Form::select('office_id', $offices, $registration->office_id, ['placeholder'=>'', 'class'=>'form-control']) }}
            </div>
          @else
            <label class="form-control-static col-md-9">
              {{ $offices[$registration->office_id] }}
            </label>
          @endif
        </div>
      </div>
    </div>

    @if($registration->stat == \App\Models\Enums\RegistrationStat::Pending)
      <hr>

      <div class="r-text">If you approve this registration, he/she will be added under your company's membership plan.</div>
      <br><br>

      <div class="text-center">
        <input type="submit" name="submit" value="APPROVE" class="more active">
        <input type="submit" name="submit" value="DECLINE" class="more active">
      </div>
    @endif

  </form>

@endsection