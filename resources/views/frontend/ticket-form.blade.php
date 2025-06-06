<?php use App\Models\Enums\TicketStat; ?>

@extends('frontend.template', ['title'=>strtoupper($action). ' TICKET'])

@section('content')
  <div id="app">
    <form method="post" action="" id="form-ticket" v-on:submit.prevent="submitForm" class="form-horizontal" enctype="multipart/form-data" >
      {{ csrf_field() }}
      <input type="hidden" name="delete" id="delete">
      <input type="hidden" v-model="submit_action" name="submit_action">
  
      <div class="form-group">
        <label class="control-label col-md-2 ticket-md-2">
          Title *
        </label>
        <div class="col-md-10 ticket-md-10">
          {{Form::text('title', $ticket->title, ['class'=>'form-control', 'autofocus'])}}
        </div>
      </div>
      
      @if($ticket->stat != null)
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label col-md-3">
                Ticket Code
              </label>
              <div class="col-md-9 form-control-static r-text">
                {{ $ticket->ticket_code }}
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="control-label col-md-3">
                Status
              </label>
              <div class="col-md-9 form-control-static r-text">
                {{ TicketStat::$values[$ticket->stat] }}
              </div>
            </div>
          </div>
        </div>
      @endif
      
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Category *
            </label>
            <div class="col-md-9">
              {{ Form::select('category_id', $categories, $ticket->category_id, ['placeholder'=>'', 'class'=>'form-control']) }}
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Urgency
            </label>
            <div class="col-md-9">
              {{Form::select('urgency', \App\Models\Enums\TicketUrgency::$values, $ticket->urgency, ['placeholder'=>'', 'class'=>'form-control'])}}
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
            <div class="col-md-9 form-control-static r-text">
              @if($ticket->stat == null)
                {{ $company->name }}
              @else
                {{ $ticket->company_name }}
              @endif
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Office Name
            </label>
            <div class="col-md-9 form-control-static r-text">
              {{ $office->name }}
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Address
            </label>
            <div class="col-md-9 form-control-static r-text" id="office_addr">
                @if($ticket->stat == null)
                  {{ $office->addr }}
                @else
                  {{ $ticket->office_addr }}
                @endif
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Postal Code
            </label>
            <div class="col-md-9 form-control-static r-text" id="office_postal">
                @if($ticket->stat == null)
                  {{ $office->postal }}
                @else
                  {{ $ticket->office_postal }}
                @endif
            </div>
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Requested By
            </label>
            <div class="col-md-9 form-control-static r-text">
              @if($action == "draft")
                {{Auth::user()->username}} on {{ ViewHelper::formatDateTime(\Carbon\Carbon::now()) }}
              @else
                {{$ticket->requested_by}} on {{ ViewHelper::formatDateTime(\Carbon\Carbon::now()) }}
              @endif
            </div>
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
        <label class="control-label col-md-2 ticket-md-2">
          Issues
        </label>
        <div class="col-md-10 ticket-md-10">
          <input type="hidden" name="issues_count" v-bind:value="issues.length">
          
          <table class="table table-bordered">
            <thead>
            <tr>
              <th width="60px"></th>
              <th>
                Image / Video<br>
                <span style="font-size:13px">(Supported image formats: png, jpg, gif)<br>
                (Supported video formats: wmv, avi, flv, mp4, mov)<br>
                  (max size 50mb)</span>
              </th>
              <th>Issue</th>
              <th>Expected Outcome</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(issue, index) in issues" v-bind:class="'row-'+issue.stat">
              <td>
                <button type="button" class="btn btn-primary" @click="deleteIssue(index)">
                  <i class="fa fa-times"></i>
                </button>
                <input type="hidden" v-bind:name="'issue_stat'+index" v-bind:value="issue.stat" v-if="issue.stat">
                <input type="hidden" v-bind:name="'issue_id'+index" v-bind:value="issue.ticket_issue_id">
              </td>
              <td>
                <div v-if="issue.image" v-bind:id="'preview-image' + index">
                  <img v-if="isImage(issue.image)" :src="'{{asset('assets/images/tickets')}}/'+ issue.image" v-if="issue.image" class="ticket-image"/>
                  <video v-else-if="isVideo(issue.image)" width="320" height="240" controls>
                    <source :src="'{{asset('assets/images/tickets')}}/'+ issue.image">
                    Your browser does not support the video tag.
                  </video>
                </div>
                <div v-else>
                  <input type="file" v-bind:name="'image' + index" v-on:change="previewImage(index,$event)">
                </div>
              </td>
              <td>
                <textarea v-bind:name="'issue' + index" class="form-control" placeholder="Issue">@{{ issue.issue_desc }}</textarea>
              </td>
              <td>
                <textarea v-bind:name="'expected' + index"  class="form-control" placeholder="Expected Outcome">@{{ issue.expected_desc }}</textarea>
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
        <label class="control-label col-md-2 ticket-md-2">
          Preferred Slots
        </label>
        <div class="col-md-10 ticket-md-10">
          <input type="hidden" name="preferred_slots_count" v-bind:value="preferred_slots.length">
          
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
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <date-picker :name="'preferred_slot_date'+index" :value="slot.date"></date-picker>
              </td>
              <td>
                <dropdown-time :name="'preferred_slot_time_start'+index" :value="slot.time_start" class="select-time"></dropdown-time>
                <dropdown-time :name="'preferred_slot_time_end'+index" :value="slot.time_end" class="select-time"></dropdown-time>
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
        @if($ticket->stat == TicketStat::Drafted || $ticket->stat == TicketStat::Opened)
          <input type="submit" @click='updateTicket' value="UPDATE TICKET" class="more active">
          <input type="submit" @click='openTicket' value="OPEN TICKET" class="more active">
          <input type="button" onclick='deleteTicket()' value="DELETE TICKET" class="more active">
        @elseif($ticket->stat == null)
          <input type="submit" @click='draftTicket' value="DRAFT TICKET" class="more active">
        @endif
      </div>
    </form>
  </div>
@endsection

@section('script')
  <script src="{{asset('assets/js/axios.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('assets/js/ticket.js')}}" type="text/javascript"></script>
  <link href="{{asset('assets/metronic/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
  <script src="{{asset('assets/metronic/global/plugins/bootstrap-toastr/toastr.min.js')}}" type="text/javascript"></script>
  
  <script>
    toastr.options.positionClass = "toast-top-center";
    toastr.options.preventDuplicates = true;
    //https://github.com/CodeSeven/toastr/issues/166
    toastr.options.timeOut = 0;
    toastr.options.extendedTimeOut = 0;
  
    $(document).ready(function() {
      $("#office_id").change(function() {
        var office_id = $(this).val();
        
        axios.get('{{url('api/getOffice')}}?office_id='+office_id)
          .then(function (response) {
            var office = response.data;
            $("#office_addr").text(office.addr);
            $("#office_postal").text(office.postal);
          })
          .catch(function (error) {
            console.log('office_id change error='+error);
          })
      });
    });
    
    var vm = new Vue({
      el: "#app",
      data: {
        issues: {!! $ticket->issues !!},
        preferred_slots: {!! $ticket->preferred_slots !!},
        submit_action: '',
      },
      methods: {
        addPreferredSlot: function() {
          var slot = {date: moment().format('YYYY-MM-DD'), time_start: '', time_end: '', stat:'add'};
          this.preferred_slots.push(slot);
        },
        deletePreferredSlot: function(index) {
          this.preferred_slots.splice(index, 1);
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
          var file_mime = e.target.files[0].type;
          if (fileMimeIsImage(file_mime) === false) {
            $('#preview-image' + index).html("Video");
            return;
          }
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
        },
        submitForm: function() {
          Vue.nextTick(function() {
            var validate = validateTicketForm();
            if (validate) {
              document.getElementById("form-ticket").submit();
            }
          });
        },
        draftTicket: function() {
          this.submit_action = "draft";
        },
        updateTicket: function() {
          this.submit_action = "update";
        },
        openTicket: function() {
          this.submit_action = "open";
        }
      }
    });
    
    function deleteTicket() {
      var result = confirm("Are you sure you want to delete the ticket?");
      if (result === true) {
        $("#delete").val('true');
        $("form").submit();
      }
    }
  </script>
@endsection