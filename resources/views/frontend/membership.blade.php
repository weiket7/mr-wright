@extends('frontend.template', [
  'header'=>'membership',
  'title'=>$frontend['contents']['membership_meta_title'],
  'meta_keyword'=>$frontend['contents']['membership_keyword'],
  'meta_desc'=>$frontend['contents']['membership_desc']
])

@section('content')

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
          <p class="list-group-item-text"><b>{{ $membership->requester_limit }}</b> users</p>
        </div>
        <div class="list-group-item">
          <p class="list-group-item-text"><b>{{ ViewHelper::formatCurrency($membership->effective_price) }}</b> per month</p>
        </div>
        <div class="list-group-item">
          <p class="list-group-item-text">Unlimited tickets</p>
        </div>
        <div class="list-group-item">
          <p class="list-group-item-text">
            <button class="btn btn-primary" onclick="location.href='{{url('register?membership_id='.$membership->membership_id)}}'">Register</button>
          </p>
        </div>
      </div>
    </div>
    @endforeach
  </div>
@endsection