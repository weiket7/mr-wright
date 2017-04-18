<?php use App\Models\Enums\TicketStat; ?>
<?php use App\Models\Enums\TicketUrgency; ?>
<?php use Carbon\Carbon; ?>

@extends('frontend.template', ['title'=>strtoupper($action). ' TICKET'])

@section('content')
  <form method="post" action="" class="form-horizontal" id="app">
    {{ csrf_field() }}

    <div class="form-group">
      <label class="control-label col-md-2">
        Title
      </label>
      <label class="col-md-10 form-control-static">
        {{ $ticket->title }}
      </label>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Ticket Code
          </label>
          <label class="col-md-9 form-control-static">
            {{ $ticket->ticket_code }}
          </label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Status
          </label>
          <label class="col-md-9 form-control-static">
            {{ TicketStat::$values[$ticket->stat] }}
          </label>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Category
          </label>
          <label class="col-md-9 form-control-static">
            {{ $ticket->category_name }}
          </label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Urgency
          </label>
          <label class="col-md-9 form-control-static">
            {{ TicketUrgency::$values[$ticket->urgency] }}
          </label>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Quoted Price
          </label>
          <label class="col-md-9 form-control-static">
            {{ ViewHelper::formatCurrency($ticket->quoted_price) }}
          </label>
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
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Office Name
          </label>
          <label class="col-md-9 form-control-static">
            {{ $ticket->office_name }}
          </label>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Address
          </label>
          <label class="col-md-9 form-control-static">
            {{ $ticket->office_addr }}
          </label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Postal Code
          </label>
          <label class="col-md-9 form-control-static">
            {{ $ticket->office_postal }}
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
          <label class="col-md-9 form-control-static">
            {!! nl2br($ticket->requester_desc) !!}
          </label>
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
            <th>Image / Video</th>
            <th>Issue</th>
            <th>Expected</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="(issue, index) in issues" v-bind:class="'row-'+issue.stat">
            <td>
              <div v-bind:id="'preview-image' + index">
                <img v-if="isImage(issue.image)" :src="'{{asset('images/tickets')}}/'+ issue.image" v-if="issue.image" class="ticket-image"/>
                <video v-else-if="isVideo(issue.image)" width="320" height="240" controls>
                  <source :src="'{{asset('images/tickets')}}/'+ issue.image">
                  Your browser does not support the video tag.
                </video>
              </div>
              <input type="file" v-bind:name="'image' + index" v-on:change="previewImage(index,$event)">
            </td>
            <td>
              @{{ issue.issue_desc }}
            </td>
            <td>
              @{{ issue.expected_desc }}
            </td>
          </tr>
          </tbody>
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
            <th>Date</th>
            <th>Time</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="(slot, index) in preferred_slots" v-bind:class="'row-'+slot.stat">
            <td>
              <input type="text" v-bind:name="'preferred_slot_date'+index" v-bind:value="slot.date | formatDate" class="form-control datepicker">
            </td>
            <td>
              <input type="text" v-bind:name="'preferred_slot_time_start'+index" v-model="slot.time_start" class="form-control time" placeholder="HH:MM am/pm">
              <input type="text" v-bind:name="'preferred_slot_time_end'+index" v-model="slot.time_end" class="form-control time" placeholder="HH:MM am/pm">
            </td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>

    @if($ticket->stat == TicketStat::Quoted)
      <div style="margin-bottom: 10px;">
          <textarea name="accept_decline_reason" title="" class="form-control txt-decline-reason" placeholder="[Optional] Please share with us the reason for accepting or declining">
          </textarea>
      </div>

      <div>
        <button type="submit" name="submit" class="btn btn-primary" value="Accept">
          Accept
        </button>
        <button type="submit" name="submit" class="btn btn-primary" value="Decline">
          Decline
        </button>
      </div>
    @elseif($ticket->stat == TicketStat::Invoiced)
      <div class="panel panel-default">
        <div class="panel-heading">Panel heading without title</div>

        <div class="panel-body">
          <label class="lbl-radio">
            <input type="radio" name="payment_method" value="R" @click="selectPaymentMethod('R')"> Credit Card
            <span></span>
          </label><br>
          <label class="lbl-radio">
            <input type="radio" name="payment_method" value="C" @click="selectPaymentMethod('C')"> Cash
            <span></span>
          </label><br>
          <label class="lbl-radio">
            <input type="radio" name="payment_method" value="N" @click="selectPaymentMethod('N')"> NETS
            <span></span>
          </label><br>
          <label class="lbl-radio">
            <input type="radio" name="payment_method" value="B" @click="selectPaymentMethod('B')"> Bank Transfer
            <span></span>
          </label><br>
          <label class="lbl-radio">
            <input type="radio" name="payment_method" value="Q" @click="selectPaymentMethod('Q')"> Cheque
            <span></span>
          </label>
          <br>
          <input type="text" name="ref_no" v-show="showRefNo" class="form-control" placeholder="Ref No">
          <br>
          <div><button type="submit" name="submit" class="btn btn-primary" value="Payment">
              Payment
            </button>
          </div>
        </div>
      </div>
    @endif

    <div class="text-center">
      <input type="button" name="submit" value="BACK TO TICKETS" class="more active" onclick="location.href='{{url('ticket')}}'">
    </div>
  </form>
@endsection

@section('script')
  <script>
    var vm = new Vue({
      el: "#app",
      data: {
        issues: {!! $ticket->issues !!},
        preferred_slots: {!! $ticket->preferred_slots !!},
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
        },
        isImage: function(file_name) {
          return fileExtensionIsImage(file_name);
        },
        isVideo: function(file_name) {
          return fileExtensionIsVideo(file_name);
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