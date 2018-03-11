@extends('frontend.template', [
  'title'=>'membership',
  'meta_title'=>$frontend['contents']['membership_meta_title'],
  'meta_keyword'=>$frontend['contents']['membership_keyword'],
  'meta_desc'=>$frontend['contents']['membership_desc']
])

@section('content')
  <style>
    .list-group-item {
      padding: 5px 10px;
    }
    .list-group-item-text {
      padding: 10px;
    }
  </style>
  
  <div class="description align-center">
    {!! $frontend['contents']['membership_content'] !!}
  </div>
  
  <?php $cols = 12 / count($memberships); ?>
  
  <div class="row page-margin-top">
    @foreach($memberships as $membership)
    <div class="col-sm-{{$cols}} col-xs-12">
      <div class="list-group">
        <div class="list-group-item membership-header">
          <h4 class="list-group-item-heading">{{ $membership->name }}</h4>
        </div>
        <div class="list-group-item">
          <p class="list-group-item-text">
            <b>{{ $membership->requester_limit }}</b>
            {{ $membership->requester_limit == 1 ? "user" : "users" }}</p>
        </div>
        @foreach($membership->details as $detail)
          <div class="list-group-item">
            <p class="list-group-item-text"><b>{{ $detail->content }}</b></p>
          </div>
        @endforeach
        <div class="list-group-item">
          <p class="list-group-item-text">
            <button class="btn btn-primary" onclick="location.href='{{url('register?membership_id='.$membership->membership_id)}}'">Register</button>
          </p>
        </div>
      </div>
    </div>
    @endforeach
  </div>

  <div class="description align-center">
    For full list of details, please check out the details <a href="{{url('membership/detail')}}">here</a>.
  </div>
@endsection