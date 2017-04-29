@extends('frontend.template', ['title'=>'register'])

@section('content')
  <div class="stepwizard">
    <div class="stepwizard-row setup-panel">
      <div class="stepwizard-step">
        <a href="#step-1" type="button" class="btn btn-circle btn-default" disabled="disabled">1</a>
        <p>Step 1</p>
      </div>
      <div class="stepwizard-step">
        <a href="#step-2" type="button" class="btn btn-default btn-circle btn-primary">2</a>
        <p>Step 2</p>
      </div>
    </div>
  </div>
  
  <form method="post" action="" class="form-horizontal" autocomplete="off" id="app">
    {{ csrf_field() }}

    {{--<div class="alert alert-info">
      By making successful payment via preferred NETS or credit card, you will be able to create a ticket immediately.
      <br><br>
      For cash, bank transfer and cheque, there will be some lead time before you will be able to create a ticket.
    </div>--}}

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Membership Plan *
          </label>
          <div class="col-md-9">
            {{ Form::select('membership_id', $memberships, session()->has('membership_id') ? session()->get('membership_id') : '', ['placeholder'=>'', 'class'=>'form-control']) }}
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Payment Method *
          </label>
          <div class="col-md-9">
            {{ Form::select('payment_method', $payment_methods, '', ['placeholder'=>'', 'class'=>'form-control', "v-model"=>'payment_method']) }}
          </div>
        </div>
      </div>
    </div>

    <div class="alert alert-info" v-show="payment_method">
      <div v-show="payment_method == 'C'">
        {!! nl2br($frontend['contents']['payment_cash']) !!}
      </div>
      <div v-show="payment_method == 'N'">
        {!! nl2br($frontend['contents']['payment_nets']) !!}
      </div>
      <div v-show="payment_method == 'Q'">
        {!! nl2br($frontend['contents']['payment_cheque']) !!}
      </div>
      <div v-show="payment_method == 'B'">
        {!! nl2br($frontend['contents']['payment_banktransfer']) !!}
      </div>
      <div v-show="payment_method == 'R'">
        {!! nl2br($frontend['contents']['payment_creditcard']) !!}
      </div>
    </div>
  
    <div class="margin-top-30">
      <div class="align-center">
        <input type="submit" name="submit" value="SUBMIT" class="more active">
      </div>
    </div>
  </form>
@endsection

@section('script')
  <script>
    var vm = new Vue({
      el: "#app",
      data: {
        payment_method: '',
      },

    });
  </script>
@endsection
