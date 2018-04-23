<?php use App\Models\Enums\MembershipStat; ?>
<?php use App\Models\Enums\MembershipType; ?>

@extends("admin.template")

@section('content')
  <h1 class="page-title">
    {{ucfirst($action)}} Membership
  </h1>

  <div class="portlet light bordered" id="app">
    <div class="portlet-body form">
      <form action="" method="post" class="form-horizontal">
        {!! csrf_field() !!}
        <div class="form-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Name <span class="required">*</span></label>
                <div class="col-md-9">
                  {{Form::text('name', $membership->name, ['class'=>'form-control'])}}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Status <span class="required">*</span></label>
                <div class="col-md-9">
                  {{Form::select('stat', MembershipStat::$values, $membership->stat, ['class'=>'form-control', 'placeholder'=>''])}}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Number of Requesters <span class="required">*</span></label>
                <div class="col-md-9">
                  {{Form::number('requester_limit', $membership->requester_limit, ['class'=>'form-control'])}}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Price <span class="required">*</span></label>
                <div class="col-md-9">
                  {{Form::number('effective_price', $membership->effective_price, ['class'=>'form-control', 'step'=>0.01])}}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Type <span class="required">*</span></label>
                <div class="col-md-9">
                  {{Form::select('type', MembershipType::$values, $membership->type, ['class'=>'form-control', 'placeholder'=>''])}}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Free Trial</label>
                <div class="col-md-9">
                  <div class="mt-checkbox-inline">
                    <label class="mt-checkbox mt-checkbox-outline">
                      {{ Form::checkbox('free_trial', 1, $membership->free_trial) }}Yes
                      <span></span>
                    </label>
                  </div>
                  <small>During registration using this membership, customer will not be required to select payment methods</small>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Details</label>
                <div class="col-md-9">
                  <input type="hidden" name="detail_count" v-model="detail_count">
                  
                  <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th width="57px"></th>
                      <th width="70px">Position</th>
                      <th>Content</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(detail, index) in details">
                      <td>
                        <button type="button" class="btn btn-icon-only blue" @click="deleteDetail(index)">
                          <i class="fa fa-times"></i>
                        </button>
                      </td>
                      <td>
                        <input type="text" class="form-control txt-num" v-bind:name="'position'+index" v-bind:value="detail.position" readonly>
                      </td>
                      <td>
                        <input type="text" class="form-control" v-bind:name="'content'+index" v-model="detail.content">
                      </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                      <td colspan="3">
                        <div class="text-center">
                          <button type="button" class="btn blue" @click='addDetail'>Add</button>
                        </div>
                      </td>
                    </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="form-actions">
          <div class="row">
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-offset-3 col-md-9">
                  <button type="submit" class="btn green">Submit</button>
                  <button type="button" class="btn blue" onclick="location.href='{{url('admin/membership')}}'">Back</button>
                </div>
              </div>
            </div>
            <div class="col-md-6"> </div>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection

@section('script')
  <script>
    var vm = new Vue({
      el: "#app",
      data: {
        details: {!! $details !!}
      },
      methods: {
        addDetail: function() {
          this.details.push({position:this.detail_count+1, content:''});
          Vue.nextTick(function() { updatePosition(); });
        },
        deleteDetail: function(index) {
          this.details.splice(index, 1);
          Vue.nextTick(function() { updatePosition(); });
        }
      },
      computed: {
        detail_count: function() {
          return this.details.length;
        }
      }
    });
    
    $(document).ready(function() {
      $("tbody").sortable({
        stop: function(event, ui) {
          updatePosition();
        }
      });
    });
    
    function updatePosition() {
      var i = 1;
      $('tbody > tr').each(function() {
        $(this).find("input.txt-num[type='text']").val(i);
        i++;
      });
    }
  </script>
@endsection