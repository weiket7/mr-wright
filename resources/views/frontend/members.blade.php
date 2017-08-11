@extends('frontend.template', ['title'=>'members'])

@section('content')
  <table class="table table-bordered">
    <thead>
    <tr>
      <td width="200px">Office</td>
      <td width="70px">Status</td>
      <td>Name</td>
    </tr>
    </thead>
    <tbody>
    @foreach($requesters as $r)
      <tr>
        <td>{{$r->office_name}}</td>
        <td>{{\App\Models\Enums\RequesterStat::$values[$r->stat]}}</td>
        <td><a href="{{url('members/save/'.$r->requester_id)}}">{{$r->name}}</a></td>
      </tr>
    @endforeach
    </tbody>
  </table>

  @if(count($registrations))
  <br>
  <h3>PENDING REGISTRATIONS</h3>
  <br>
  <table class="table table-bordered">
    <thead>
    <tr>
      <th width="70px">Status</th>
      <th>Name</th>
      <th>Designation</th>
      <th>Registered On</th>
    </tr>
    </thead>
    @foreach($registrations as $r)
      <tr>
        <td><span class="label label-warning"> Pending </span></td>
        <td><a href="{{url('members/registration/'.$r->registration_id)}}">{{ $r->name }}</a></td>
        <td>{{ $r->designation }}</td>
        <td>{{ ViewHelper::formatDateTime($r->created_on) }}</td>
      </tr>
    @endforeach
  </table>
  @endif

  <br>
  <h3>INVITE</h3>
  @if($hit_requester_limit)
    <div class="alert alert-info">
      The current number of requesters has hit the limit from the membership plan {{ $company->membership_name }}.
      <br>
      Would you like to <a href="{{url('membership/upgrade')}}">upgrade the membership plan</a>?
    </div>
  @else
    <div class="description" style="margin-top: 10px; margin-bottom: 10px;">
      {{ $frontend['contents']['invite_content'] }}
    </div>
    
    @if(session()->has('invited_email'))
      <div class="alert alert-success">
        Invite has been sent to {{ session()->get('invited_email') }}
      </div>
    @endif
    
    <form method="post" action="" class="form-horizontal">
      {{csrf_field()}}
  
      <div class="r-row">
        <div class="form-group">
          <label class="control-label col-md-2">
            Email
          </label>
          <div class="col-md-10">
            {{ Form::email('email', '', ['class'=>'form-control', 'maxlength'=>100, 'required']) }}
          </div>
        </div>
      </div>
  
      <div class="r-row">
        <div class="form-group">
          <label class="control-label col-md-2">
            Office
          </label>
          <div class="col-md-10">
            {{ Form::select('office_id', $offices, '', ['placeholder'=>'', 'class'=>'form-control', 'required']) }}
          </div>
        </div>
  
        <div class="text-center">
          <input type="submit" name="submit" value="INVITE" class="more active">
        </div>
      </div>
    </form>
  @endif
  

@endsection