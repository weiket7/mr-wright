@extends('frontend.template', ['title'=>'account'])

@section('content')

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
              {{ Form::text('company_addr', $requester->company_addr, ['class'=>'form-control', 'maxlength'=>200]) }}
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

    @if($requester->admin)
      <table class="table table-bordered">
        <thead>
        <tr>
          <th>Office Name</th>
          <th>Address</th>
          <th>Postal</th>
        </tr>
        </thead>
        <tbody>
          @foreach($offices as $office)
            <tr>
              <td><a href="{{ url("office/save/".$office->office_id) }}">{{ $office->name }}</a></td>
              <td>{{ $office->addr }}</td>
              <td>{{ $office->postal }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif

    <div class="margin-top-30">
      <div class="align-center">
        <input type="submit" name="submit" value="SAVE" class="more active">
      </div>
    </div>

  </form>
@endsection