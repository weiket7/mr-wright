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

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Membership Plan *
          </label>
          <div class="col-md-9">
            <select name="membership_id" class="form-control" v-model="selected_membership_id">
              <option value=""></option>
              <option v-for="membership in memberships" :value="membership.membership_id">@{{ membership.name }}</option>
            </select>
          </div>
        </div>
      </div>
      <div class="col-md-6" v-if="show_payment_methods">
        <div class="form-group">
          <label class="control-label col-md-3">
            Payment Method *
          </label>
          <div class="col-md-9">
            {{ Form::select('payment_method', $payment_methods, '', ['class'=>'form-control', "v-model"=>'payment_method']) }}
          </div>
        </div>
      </div>
    </div>

    <div class="alert alert-info" v-if="payment_method">
      <div v-if="payment_method == 'C'">
        {!! nl2br($frontend['contents']['payment_cash']) !!}
      </div>
      <div v-if="payment_method == 'N'">
        {!! nl2br($frontend['contents']['payment_nets']) !!}
      </div>
      <div v-if="payment_method == 'Q'">
        {!! nl2br($frontend['contents']['payment_cheque']) !!}
      </div>
      <div v-if="payment_method == 'B'">
        {!! nl2br($frontend['contents']['payment_banktransfer']) !!}
      </div>
      <div v-if="payment_method == 'R'">
        {!! nl2br($frontend['contents']['payment_creditcard']) !!}
      </div>

      <div class="row" v-if="payment_method == 'Q' || payment_method == 'B'">
        <br>
        <div class="col-md-2">
          <label class="control-label">
            Ref No
          </label>
        </div>
        <div class="col-md-10">
          {{ Form::text('ref_no', '', ['class'=>'form-control']) }}
        </div>
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
        memberships: {!! json_encode($memberships) !!},
        selected_membership_id: null,
        payment_method: ''
      },
      computed: {
        is_free_trial: function() {
          if (this.selected_membership_id != null) {
            return this.memberships[this.selected_membership_id].free_trial == 1;
          }
        },
        show_payment_methods: function() {
          return this.selected_membership_id != null && this.is_free_trial == false;
        }
      }
    });
  </script>
@endsection
