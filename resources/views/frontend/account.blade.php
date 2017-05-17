@extends('frontend.template', ['title'=>'account'])

@section('content')
  @if(session()->has('welcome'))
    <div class="alert alert-info">
      Welcome to Mr Wright, would you like to start by <a href="{{url('ticket/save')}}">creating a ticket</a>?
    </div>
  @endif
  
  <form method="post" action="" class="form-horizontal">
    {{ csrf_field() }}

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Username
          </label>
          <label class="form-control-static col-md-9">
            {{ $requester->username }}
          </label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Password
          </label>
          <div class="col-md-9">
            <input type="password" name="password" class="form-control">
            <span class="help-block">Fill in password field only when you want to update the password</span>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Full Name *
          </label>
          <div class="col-md-9">
            {{ Form::text('name', $requester->name, ['class'=>'form-control', 'maxlength'=>50]) }}
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Designation *
          </label>
          <div class="col-md-9">
            {{ Form::text('designation', $requester->designation, ['class'=>'form-control', 'maxlength'=>30]) }}
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Mobile *
          </label>
          <div class="col-md-9">
            {{ Form::text('mobile', $requester->mobile, ['class'=>'form-control', 'maxlength'=>30]) }}
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Email *
          </label>
          <div class="col-md-9">
            {{ Form::text('email', $requester->email, ['class'=>'form-control', 'maxlength'=>100]) }}
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Company Name
          </label>
          <div class="col-md-9">
            <label class="form-control-static">
              {{ $requester->company_name }}
            </label>
          </div>
        </div>
      </div>
      @if($requester->admin)
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              UEN *
            </label>
            <div class="col-md-9">
              <label class="form-control-static">
                {{ $requester->uen }}
              </label>
            </div>
          </div>
        </div>
      @else
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Office Name
            </label>
            <div class="col-md-9">
              {{ Form::text('office_name', $requester->office_name, ['class'=>'form-control', 'maxlength'=>200]) }}
            </div>
          </div>
        </div>
      @endif
    </div>

    @if($requester->admin)
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Company Address *
            </label>
            <div class="col-md-9">
              {{ Form::textarea('company_addr', $requester->company_addr, ['rows'=>2, 'class'=>'form-control', 'maxlength'=>200]) }}
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Company Postal Code *
            </label>
            <div class="col-md-9">
              {{ Form::text('company_postal', $requester->company_postal, ['class'=>'form-control', 'maxlength'=>20]) }}
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Membership Plan
            </label>
            <div class="col-md-9">
              <label class="form-control-static">
                {{ $requester->membership_name }}
              </label>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Number of Requesters
            </label>
            <div class="col-md-9">
              <label class="form-control-static">
                {{ $requester->requester_count }}
              </label>
            </div>
          </div>
        </div>
      </div>
    @else
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Office Address *
            </label>
            <div class="col-md-9">
              {{ Form::text('office_addr', $requester->office_addr, ['class'=>'form-control', 'maxlength'=>200]) }}
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Office Postal Code *
            </label>
            <div class="col-md-9">
              {{ Form::text('office_postal', $requester->office_postal, ['class'=>'form-control', 'maxlength'=>20]) }}
            </div>
          </div>
        </div>
      </div>
    @endif

    <div class="text-center">
      <input type="submit" name="submit" value="SAVE" class="more active">
    </div>

    @if($requester->admin)
      <h3>Offices</h3>
      <br>

      <a href="{{url('office/save')}}">Create Office</a>
      <br><br>

      <table class="table table-bordered">
        <thead>
        <tr>
          <th>Office Name</th>
          <th>Address</th>
          <th>Postal</th>
          <th>Number of Requesters</th>
        </tr>
        </thead>
        <tbody>
        @foreach($offices as $office)
          <tr>
            <td><a href="{{ url("office/save/".$office->office_id) }}">{{ $office->name }}</a></td>
            <td>{{ $office->addr }}</td>
            <td>{{ $office->postal }}</td>
            <td>{{ $office->requester_count }}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
    @endif


  </form>
@endsection