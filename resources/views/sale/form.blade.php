@extends('template',
  ['title'=>'Sale']
)

@section('content')
  
  <div class="row">
    <div class="col-md-4 col-sm-12">
      <div class="portlet yellow-lemon box">
        <div class="portlet-title">
          <div class="caption">
            <i class="fa fa-user"></i>Details
          </div>
        </div>
        <div class="portlet-body">
          <div class='form-horizontal'>
            <div class="form-group">
              <label class="col-md-3 control-label">Customer</label>
              <div class="col-md-9">
                <input type='text' class='form-control select2me' id='select2me'>
                <input type='hidden' name='cust' id='cust'>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Outlet</label>
              <div class="col-md-9">
                <select class='form-control' ng-change="changeOutlet(outlet)" ng-model="outlet" name='outlet'>
                  
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-8 col-sm-12">
      <div class="portlet green-jungle box">
        <div class="portlet-title">
          <div class="caption">
            <i class="fa fa-list-ul"></i>Items
            <input type='text' ng-model="searchItems" style='color: black'>
          </div>
        </div>
        <div class="portlet-body">
          
          <div class="scroller" style="height:145px" data-always-visible="1" data-rail-visible="1" data-rail-color="blue" data-handle-color="red">
            <table class="table table-hover table-bordered">
              <thead>
              <tr>
                <th>Dept</th>
                <th>Item</th>
                <th>Price</th>
                <th>Available</th>
              </tr>
              </thead>
              <tbody ng-repeat="item in items | filter:searchItems">
              <tr>
                <td>[[item.dept]]</td>
                <td ng-click='addItem(item)'>[[item.item_name]]</td>
                <td>[[item.unit_sell_price]]</td>
                <td>[[item.available_qty]]</td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 col-sm-12">
      <div class="portlet blue-hoki box">
        <div class="portlet-title">
          <div class="caption">
            <i class="fa fa-shopping-cart"></i>Sales
          </div>
        </div>
        <div class="portlet-body" >
          <div class="table-responsive">
            <table class="table table-hover table-bordered">
              <thead>
              <tr>
                <th></th>
                <th>Item</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
              </tr>
              </thead>
              <tbody ng-repeat="item in cart">
              <tr>
                <td ng-click='removeItem(item)'><i class="fa fa-times"></i></td>
                <td>[[item.item_name]]</td>
                <td>
                  <div class="form-inline">
                          <span class='input-group' style='width:120px'>
                            <span class="input-group-btn">
                            <button class="btn red" type="button" ng-click='decrement(item)'>-</button>
                            </span>
                            <input type='text' value='[[item.sell_qty]]' class='form-control num' >
                            <span class="input-group-btn">
                            <button class="btn blue" type="button" ng-click='increment(item)'>+</button>

                            </span>
                          </span>
                    / [[item.available_qty]]
                  </div>
                </td>
                <td>[[item.unit_sell_price]]</td>
                <td>[[item.subtotal]]</td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="portlet box blue">
        <div class="portlet-title">
          <div class="caption">
            <i class="fa fa-cogs"></i>Payment
          </div>
        </div>
        <div class="portlet-body">
          <div class="row static-info">
            <div class="col-md-6 name">
              <input type='text' class='form-control' ng-model="cash" name="cash">
              <button type="button" class="btn blue" style='width:100%' ng-click="pay('cash')">Cash</button>
              <!-- <button type="button" class="btn blue" ng-click="selectedMethod=1" ng-class="{'green':selectedMethod==1}" style='width:100%' >Cash</button> -->
            </div>
            <div class="col-md-6 value">
              <input type='text' class='form-control' ng-model="credit" name="credit">
              <button type="button" class="btn blue" style='width:100%' ng-click="pay('credit')">Credit Card</button>
              <!-- <input type="button" class="btn blue" value="Credit Card" style='width:100%' ng-click="selectedMethod=2" ng-class="{'green':selectedMethod==2}" > -->
            </div>
          </div>
          <div class="row static-info">
            <div class="col-md-6 name">
              <input type='text' class='form-control' ng-model="nets" name="nets">
              <button type="button" class="btn blue" style='width:100%' ng-click="pay('nets')">NETS</button>
            </div>
            <div class="col-md-6 value">
              <input type='text' class='form-control' ng-model="paypal" name="paypal">
              <button type="button" class="btn blue" style='width:100%' ng-click="pay('paypal')">Paypal</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="well">
        <div class="row static-info align-reverse">
          <div class="col-md-8 name">
            Total:
          </div>
          <div class="col-md-3 value">
            [[total | currency]]
          </div>
        </div>
        <div class="row static-info align-reverse">
          <div class="col-md-8 name">
            Paid:
          </div>
          <div class="col-md-3 value">
            [[paid | currency]]
          </div>
        </div>
        <div class="row static-info align-reverse">
          <div class="col-md-8 name">
            Balance:
          </div>
          <div class="col-md-3 value">
            [[balance | currency]]
          </div>
        </div>
        <div class="row static-info align-reverse">
          <div class="col-md-8 name">
            Change:
          </div>
          <div class="col-md-3 value">
            [[change | currency]]
          </div>
        </div>
        <div class="row static-info align-reverse">
          <div class="col-md-6">
          </div>
          <div class="col-md-6">
            <div ng-show="complete">
              <button type='submit' class='btn green' onclick>Complete</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
<script>
  jQuery(document).ready(function() {
    Metronic.init(); // init metronic core components
    Layout.init(); // init current layout
    QuickSidebar.init(); // init quick sidebar
    //Demo.init(); // init demo features
    //ComponentsDropdowns.init();
    
    toastr.options = {
      "closeButton": true,
      "showMethod": "fadeIn",
      /*"showDuration": "50000",
       "hideDuration": "50000",
       "timeOut": "50000",
       "extendedTimeOut": "50000",*/
      "positionClass": "toast-top-center"
    }
    
    @if(Session::has('msg'))
      toastr.success('{{Session::get('msg')}}');
    @endif
  });
</script>

@endsection