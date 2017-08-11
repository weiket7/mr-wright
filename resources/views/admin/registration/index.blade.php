<?php use App\Models\Enums\RegistrationStat; ?>

@extends("admin.template")

@section("content")
  <div class="row">
    <div class="col-md-6">
      <h1 class="page-title">Registrations</h1>
    </div>
  </div>

  <div class="portlet light bordered">
    <div class="portlet-body">
      <form action="" method="post">
        {!! csrf_field() !!}
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
            <tr>
              <th class="search-th-stat">Status</th>
              <th class="search-th-txt">Company Name</th>
              <th class="search-th-txt">UEN</th>
              <th>Registered On</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>{!! Form::select('stat', RegistrationStat::$values, '', ['class'=>'form-control search-stat', 'placeholder'=>'']) !!}</td>
              <td>{!! Form::text('company_name', '', ['class'=>'form-control search-txt']) !!}</td>
              <td>{!! Form::text('uen', '', ['class'=>'form-control search-txt']) !!}</td>
              <td>
                <div class="input-group input-large datepicker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
                  <input type="text" class="form-control" name="date_from" placeholder="From">
                  <span class="input-group-addon"> to </span>
                  <input type="text" class="form-control" name="date_to" placeholder="To">
                </div>
              </td>
            </tr>
            </tbody>
          </table>
        </div>

        <div class="row">
          <div class="col-md-12 text-center">
            <button type="submit" name="submit" class="btn blue" value="Search">Search</button>
            <button type="reset" class="btn green">Clear</button>
          </div>
        </div>
      </form>
    </div>
  </div>


  <div class="portlet light bordered">
    <div class="portlet-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
          <tr>
            <th width="100px">Status</th>
            <th>Name</th>
            <th>Username</th>
            <th>Designation</th>
            <th>Company Name</th>
            <th>UEN</th>
            <th>Membership Plan</th>
            <th>Registered On</th>
          </tr>
          </thead>
          <tbody>
          @foreach($registrations as $registration)
            <tr>
              <td>
                <span class="label label-primary"> {{ RegistrationStat::$values[$registration->stat] }} </span>
              </td>
              <td><a href="{{url("admin/registration/save/".$registration->registration_id)}}">{{ $registration->name }}</a></td>
              <td>{{ $registration->username }}</td>
              <td>{{ $registration->designation }}</td>
              <td>{{ $registration->company_name }}</td>
              <td>{{ $registration->uen }}</td>
              <td>{{ $registration->membership_name }}</td>
              <td>{{ ViewHelper::formatDateTime($registration->created_on) }}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
