<?php use App\Models\Enums\TicketStat; ?>
<?php use App\Models\Enums\TicketUrgency; ?>
<?php use Carbon\Carbon; ?>

@extends('frontend.template')

@section('content')
  <div class="r-row gray full-width page-header vertical-align-table">
    <div class="r-row full-width padding-top-bottom-50 vertical-align-cell">
      <div class="r-row">
        <div class="page-header-left">
          <h1>{{ strtoupper($action) }} TICKET</h1>
        </div>
      </div>
    </div>
  </div>

  <div class="r-row margin-bottom-40 margin-top-40" id="app">
    <form method="post" action="" class="form-horizontal">
      {{ csrf_field() }}

      <div class="form-group">
        <label class="control-label col-md-2">
          Title
        </label>
        <div class="col-md-10">
          {{Form::text('title', '', ['class'=>'form-control'])}}
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Category
            </label>
            <div class="col-md-9">
              {{ Form::select('category', $categories, $ticket->category_id, ['placeholder'=>'', 'class'=>'form-control']) }}
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Urgency
            </label>
            <div class="col-md-9">
              {{Form::select('urgency', TicketUrgency::$values, $ticket->urgency, ['placeholder'=>'', 'class'=>'form-control'])}}
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
            <label class="col-md-9 form-control-static">
              {{ $ticket->company_name }}
            </label>
          </div>
        </div>
        {{--<div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Office Name
            </label>
            <div class="col-md-9">
              {{Form::text('urgency', $ticket->office_name, ['class'=>'form-control'])}}
            </div>
          </div>
        </div>--}}
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Address
            </label>
            <label class="col-md-9 form-control-static">
              {{ $ticket->addr }}
            </label>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Postal Code
            </label>
            <label class="col-md-9 form-control-static">
              {{ $ticket->postal }}
            </label>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Requested By
            </label>
            <label class="col-md-9 form-control-static">
              Jessie on {{ ViewHelper::formatDateTime(Carbon::now()) }}
            </label>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Description
            </label>
            <div class="col-md-9">
              {{Form::textarea('requester_desc', $ticket->requester_desc, ['rows'=>3, 'class'=>'form-control'])}}
            </div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-md-2">
          Issues
        </label>
        <div class="col-md-10">
          <table class="table table-bordered">
            <thead>
            <tr>
              <th width="60px"></th>
              <th>Image / Video</th>
              <th>Issue</th>
              <th>Expected</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(issue, index) in issues" v-bind:class="'row-'+issue.stat">
              <td>
                <button type="button" class="btn btn-primary" @click="deleteIssue(index)">
                <i v-if="issue.stat" class="fa fa-undo"></i>
                <i v-else="" class="fa fa-times"></i>
                </button>
                <input type="hidden" v-bind:name="'issue_stat'+index" v-bind:value="issue.stat" v-if="issue.stat">
                <input type="hidden" v-bind:name="'issue_id'+index" v-bind:value="issue.ticket_issue_id">
              </td>
              <td>
                <div v-bind:id="'preview-image' + index">
                  <img :src="'{{asset('images/tickets')}}/'+ issue.image " v-if="issue.image" class="ticket-image"/>
                </div>
                <input type="file" v-bind:name="'image' + index" v-on:change="previewImage(index,$event)">
              </td>
              <td>
                <textarea v-bind:name="'issue' + index" class="form-control" placeholder="Issue">@{{ issue.issue_desc }}</textarea>
              </td>
              <td>
                <textarea v-bind:name="'expected' + index"  class="form-control" placeholder="Expected">@{{ issue.expected_desc }}</textarea>
              </td>
            </tr>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="4" class="text-center">
                  <div class="text-center">
                    <button type="button" @click="addIssue" class="btn btn-primary">Add</button>
                  </div>
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>

      <div class="form-group">
        <label class="control-label col-md-2">
          Preferred Slots
        </label>
        <div class="col-md-10">
          <table class="table table-bordered">
            <thead>
            <tr>
              <th width="60px"></th>
              <th>Date</th>
              <th>Time</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(slot, index) in preferred_slots" v-bind:class="'row-'+slot.stat">
              <td>
                <button type="button" class="btn btn-primary" @click="deletePreferredSlot(index)">
                  <i v-if="slot.stat" class="fa fa-undo"></i>
                  <i v-else="" class="fa fa-times"></i>
                </button>
                <input type="hidden" v-bind:name="'preferred_slot_stat'+index" v-bind:value="slot.stat" v-if="slot.stat">
                <input type="hidden" v-bind:name="'preferred_slot_id'+index" v-bind:value="slot.ticket_preferred_slot_id">
              </td>
              <td>
                <input type="text" v-bind:name="'preferred_slot_date'+index" v-bind:value="slot.date | formatDate" class="form-control datepicker">
              </td>
              <td>
                <input type="text" v-bind:name="'preferred_slot_time_start'+index" v-model="slot.time_start" class="form-control time" placeholder="HH:MM am/pm">
                <input type="text" v-bind:name="'preferred_slot_time_end'+index" v-model="slot.time_end" class="form-control time" placeholder="HH:MM am/pm">
              </td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
              <td colspan="4">
                <div class="text-center">
                  <button type="button" @click="addPreferredSlot" class="btn btn-primary">Add</button>
                </div>
              </td>
            </tr>
            </tfoot>
          </table>
        </div>
      </div>

      <div class="text-center">
        <input type="submit" name="submit" value="{{ strtoupper($action) }} TICKET" class="more active">
      </div>
    </form>
  </div>
@endsection

@section('script')
  <script>
    var vm = new Vue({
      el: "#app",
      data: {
        preferred_slots: [],
        issues: [],
        currentDate: moment()
      },
      methods: {
        addPreferredSlot: function() {
          var slot = {date: this.currentDate.format('YYYY-MM-DD'), time_start: '', time_end: '', stat:'add'};
          this.preferred_slots.push(slot);
        },
        deletePreferredSlot: function(index) {
          var slot = this.preferred_slots[index];
          if (slot.stat === 'add') {
            this.preferred_slots.splice(index, 1);
          }

          if (slot.stat == 'delete') {
            slot.stat = '';
          } else {
            Vue.set(slot, 'stat', 'delete');
            this.preferred_slots_delete.push(slot.ticket_issue_id);
          }
        },
        addIssue: function() {
          this.issues.push({image:'', issue_desc:'', expected_desc:'', stat:'add'});
        },
        deleteIssue: function(index) {
          var issue = this.issues[index];
          if (issue.stat === 'add') {
            this.issues.splice(index, 1);
          }

          if (issue.stat == 'delete') {
            issue.stat = '';
          } else {
            Vue.set(issue, 'stat', 'delete');
          }
        },
        previewImage: function(index,e) {
          var reader = new FileReader();
          reader.onload = function (e) {
            var img = $('<img/>', {
              width:250,
              height:200,
              src: e.target.result
            });
            $('#preview-image'+index).html(img);
          };
          var file = e.target.files[0];
          reader.readAsDataURL(file);
        }
      },
      filters: {
        formatDate: function (value) {
          if (value instanceof moment === false) {
            value = moment(value, "YYYY-MM-DD");
          }
          return value.format('DD MMM YYYY');
        },
        formatTime: function(value) {
          if (typeof value === "undefined" || value === "") {
            return '';
          }
          if (value instanceof moment === false) {
            value = moment(value, "HH:mm:ss");
          }
          return value.format('h:mma');
        }
      }
    });
  </script>
@endsection