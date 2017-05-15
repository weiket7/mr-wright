<?php use App\Models\Enums\TicketStat; ?>
<?php use App\Models\Enums\TicketUrgency; ?>

@extends("admin.template")

@section('content')
  <h1 class="page-title">
    {{ucfirst($action)}} Ticket
  </h1>

  <div class="portlet light bordered" id="app">
    <div class="portlet-body form">

      <div class="tabbable">
        <ul class="nav nav-tabs">
          <li class="active">
            <a href="#tab-general" data-toggle="tab">
              Ticket </a>
          </li>
          @if($action == 'update')
          <li>
            <a href="#tab-history" data-toggle="tab">History</a>
          </li>
          @endif
        </ul>
        <div class="tab-content no-space">
          <div class="tab-pane fade active in" id="tab-general">
            <form action="" method="post" id="form-ticket" v-on:submit.prevent="submitForm" class="form-horizontal" enctype="multipart/form-data">
              {!! csrf_field() !!}
              <input type="hidden" v-model="submit_action" name="submit_action">

              <div class="form-body">
                <div class="form-group">
                  <label class="control-label col-md-2">Title</label>
                  <div class="col-md-10">
                    {{Form::text('title', $ticket->title, ['class'=>'form-control'])}}
                  </div>
                </div>
                @if($action !== 'create')
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label col-md-3">Ticket Code</label>
                        <div class="col-md-9">
                          <div class="form-control-static">
                            {{ $ticket->ticket_code }}
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label col-md-3">Status</label>
                        <div class="col-md-9">
                          <div class="form-control-static">
                            {{ TicketStat::$values[$ticket->stat] }}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endif

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Category</label>
                      <div class="col-md-9">
                        {{Form::select('category_id', $categories, $ticket->category_id, ['class'=>'form-control', 'placeholder'=>''])}}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Urgency</label>
                      <div class="col-md-9">
                        {{Form::select('urgency', TicketUrgency::$values, $ticket->urgency, ['id'=>'requester_id', 'class'=>'form-control', 'placeholder'=>''])}}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Company</label>
                      <div class="col-md-9">
                        {{Form::select('company_id', $companies, $ticket->company_id, ['id'=>'company_id', 'class'=>'form-control', 'placeholder'=>''])}}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Office</label>
                      <div class="col-md-9">
                        {{Form::select('office_id', $offices, $ticket->office_id, ['id'=>'office_id', 'class'=>'form-control', 'placeholder'=>''])}}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Office Address</label>
                      <div class="col-md-9 form-control-static">
                        <div id="office_addr"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Office Postal</label>
                      <div class="col-md-9 form-static-control">
                        <div id="office_postal"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Requested By</label>
                      <div class="col-md-9">
                        {{Form::select('requested_by', $requesters, $ticket->requested_by, ['id'=>'requested_by', 'class'=>'form-control', 'placeholder'=>''])}}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Requested On</label>
                      <div class="col-md-9">
                        {{Form::text('requested_on', ViewHelper::formatDate($ticket->requested_on), ['class'=>'form-control datepicker', 'placeholder'=>''])}}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Requester Description</label>
                      <div class="col-md-9">
                        {{Form::textarea('requester_desc', $ticket->requester_desc, ['class'=>'form-control', 'rows'=>3])}}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Operator Description</label>
                      <div class="col-md-9">
                        {{Form::textarea('operator_desc', $ticket->operator_desc, ['class'=>'form-control', 'rows'=>3])}}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Quoted Price</label>
                      <div class="col-md-9">
                        {{Form::number('quoted_price', ViewHelper::formatNumber($ticket->quoted_price), ['class'=>'form-control', 'step'=>".01" ])}}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Quotation Description</label>
                      <div class="col-md-9">
                        {{Form::textarea('quotation_desc', $ticket->quotation_desc, ['class'=>'form-control', 'rows'=>3])}}
                      </div>
                    </div>
                  </div>
                </div>
                @if ($ticket->stat == TicketStat::Quoted)
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label col-md-3">Quote Valid Till</label>
                        <div class="col-md-9">
                          <div class="form-control-static">
                            {{ ViewHelper::formatDate($ticket->quote_valid_till) }} (inclusive)
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">

                    </div>
                  </div>
                @endif

                @if($ticket->stat == TicketStat::Declined)
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label col-md-3">Decline Reason</label>
                        <div class="col-md-9">
                          {{Form::text('decline_reason', ViewHelper::formatNumber($ticket->decline_reason), ['class'=>'form-control'])}}
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                    </div>
                  </div>
                @endif
                <div class="form-group">
                  <label class="control-label col-md-2">Issues</label>
                  <div class="col-md-10">
                    <input type="hidden" name="issues_count" v-bind:value="issues.length">

                    <table class="table table-bordered no-margin-btm">
                      <thead>
                      <tr>
                        <th width="57px"></th>
                        <th width="255px">
                          Image / Video<br>
                          Supported image formats: png, jpg, gif, video formats: wmv, avi, flv, mp4, mov
                        </th>
                        <th>Issue</th>
                        <th>Expected</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr v-for="(issue, index) in issues" v-bind:class="'row-'+issue.stat">
                        <td>
                          <button type="button" class="btn btn-icon-only blue" @click="deleteIssue(index)">
                          <i v-if="issue.stat" class="fa fa-undo"></i>
                          <i v-else="" class="fa fa-times"></i>
                          </button>
                          <input type="hidden" v-bind:name="'issue_stat'+index" v-bind:value="issue.stat" v-if="issue.stat">
                          <input type="hidden" v-bind:name="'issue_id'+index" v-bind:value="issue.ticket_issue_id">
                        </td>
                        <td>
                          <div v-bind:id="'preview-image' + index">
                            <img v-if="isImage(issue.image)" :src="'{{asset('assets/images/tickets')}}/'+ issue.image" v-if="issue.image" class="ticket-image"/>
                            <video v-else-if="isVideo(issue.image)" width="320" height="240" controls>
                              <source :src="'{{asset('assets/images/tickets')}}/'+ issue.image">
                              Your browser does not support the video tag.
                            </video>
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
                        <td colspan="4">
                          <div class="text-center">
                            <button type="button" class="btn blue" @click='addIssue'>Add</button>
                          </div>
                        </td>
                      </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-2">Preferred Slots</label>
                  <div class="col-md-10">
                    <input type="hidden" name="preferred_slots_count" v-bind:value="preferred_slots.length">

                    <table class="table table-bordered no-margin-btm">
                      <thead>
                      <tr>
                        <th width="57px"></th>
                        <th width="210px">Date</th>
                        <th>Time</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr v-for="(slot, index) in preferred_slots" v-bind:class="'row-'+slot.stat">
                        <td>
                          <button type="button" class="btn btn-icon-only blue" @click="deletePreferredSlot(index)">
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
                          <dropdown-time :name="'preferred_slot_time_start'+index" :value="slot.time_start" class="select-time"></dropdown-time>
                          <dropdown-time :name="'preferred_slot_time_end'+index" :value="slot.time_end" class="select-time"></dropdown-time>
                        </td>
                      </tr>
                      </tbody>
                      <tfoot>
                      <tr>
                        <td colspan="3">
                          <div class="text-center">
                            <button type="button" class="btn blue" @click='addPreferredSlot'>Add</button>
                          </div>
                        </td>
                      </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-2">Skills</label>
                  <div class="col-md-10">
                    <div class="mt-checkbox-inline">
                      @foreach($skills as $skill_id => $name)
                        <label class="mt-checkbox mt-checkbox-outline">
                          <?php $checked = in_array($skill_id, $ticket->skills) ? "checked" : ""; ?>
                          <input type="checkbox" value="{{$skill_id}}" name="skills" {{$checked}}> {{ $name }}
                          <span></span>
                        </label>
                      @endforeach
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-2">Staffs</label>
                  <div class="col-md-10">
                    <select id="staffs" class="form-control select2-multiple" multiple="multiple">
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-2">Date</label>
                  <div class="col-md-10">
                    <div class="input-group" style="max-width:300px">
                      <span class="input-group-btn">
                          <button class="btn red" type="button" @click="previousDate">Previous</button>
                      </span>
                      <input type="text" id="date" name="date" v-model="currentDateFormatted" class="form-control datepicker datepicker-width">
                      <span class="input-group-btn">
                          <button class="btn red" type="button" @click="nextDate">Next</button>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="" class="control-label col-md-2">Calendar</label>
                  <div class="col-md-10">
                    <input type='hidden' name="staff_assignments" id="staff_assignments" value="{{ json_encode($ticket->staff_assignments) }}"/>
                    <div id="div-calendar"></div>
                  </div>
                </div>

              </div>

              <div class="form-actions">
                <div class="row">
                  <div class="col-md-offset-2 col-md-10">
                    @if($ticket->stat == null)
                      <input type="submit" @click='draftTicket' value="Draft Ticket" class="btn blue">
                    @elseif($ticket->stat == TicketStat::Drafted)
                      <input type="submit" @click='updateTicket' value="Update Ticket" class="btn blue">
                      <input type="submit" @click='openTicket' value="Open Ticket" class="btn blue">
                    @elseif($ticket->stat == TicketStat::Opened)
                      <input type="submit" @click='updateTicket' value="Update Ticket" class="btn blue">
                      <input type="submit" @click='sendQuotation' value="Send Quotation" class="btn blue">
                    @endif

                    @if($ticket->stat == TicketStat::Quoted)
                      <div class="alert alert-info">
                        Quotation has been sent. Waiting for customer's response.
                      </div>
                    @endif
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="tab-pane fade" id="tab-history">
            @include('admin.ticket.history', ['ticket'=>$ticket])
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script src="{{asset('assets/js/ticket.js')}}" type="text/javascript"></script>
  
  <script>
    $(document).ready(function() {
      $("#staffs").select2({
        allowClear: true,
        placeholder: "Select"
      }).on('select2:unselecting', function() {
        //unselect prevent open dropdown
        //http://stackoverflow.com/questions/29618382/disable-dropdown-opening-on-select2-clear
        $(this).data('unselecting', true);
      }).on('select2:opening', function(e) {
        if ($(this).data('unselecting')) {
          $(this).removeData('unselecting');
          e.preventDefault();
        }
      }).on("select2:select select2:unselect", function(e) {
        getValuesAndPopulateCalendar();
      });


      $("input[name='skills']").click(function() {
        populateStaffsAndCalendar();
      });

      $("#date").on('changeDate', function() {
        getValuesAndPopulateCalendar();
      });

      populateStaffsAndCalendar();
    });

    function validateTicketForm() {
      var validate = true;
      $(".select-time").each(function() {
        var time = $(this).val();
        //console.log('time='+time);
        if (time == '') {
          $(this).addClass("txt-error");
          validate = false;
        } else {
          $(this).removeClass("txt-error");
        }
      });
      if (validate == false) {
        toastr.error("Select time");
      }
      return validate;
    }

    var selected_cells = {!! json_encode($ticket->staff_assignments) !!};

    function selectSlot(cell) {
      if ($(cell).hasClass('calendar-assigned-other-ticket')) {
        return;
      }

      var date = $(cell).attr('data-date');
      var time = $(cell).attr('data-time');
      var staff_id = $(cell).attr('data-staff_id');
      //console.log('date=' + date + ' time=' + time + ' staff_id=' + staff_id);
      if ($(cell).hasClass('calendar-assigned-current-ticket')) {
        removeFromCalendarObject(selected_cells, staff_id, date, time);
        $(cell).removeClass('calendar-assigned-current-ticket');
        $(cell).addClass('calendar-assigned-remove');
      } else if ($(cell).hasClass('calendar-assigned-remove')) {
        pushToCalendarObject(selected_cells, staff_id, date, time);
        $(cell).removeClass('calendar-assigned-remove');
        $(cell).addClass('calendar-assigned-current-ticket');
      } else if ($(cell).hasClass('calendar-selected')) {
        removeFromCalendarObject(selected_cells, staff_id, date, time);
        $(cell).removeClass('calendar-selected');
      } else {
        pushToCalendarObject(selected_cells, staff_id, date, time);
        $(cell).addClass('calendar-selected');
      }

      $("#staff_assignments").val(JSON.stringify(selected_cells));
    }

    function populateStaffsAndCalendar() {
      var skill_ids = getSelectedCheckboxesByName('skills');

      axios.get('{{url('api/getStaffWithSkills')}}?skill_ids='+skill_ids)
      .then(function (response) {
        //change select2 options
        //https://github.com/select2/select2/issues/2830
        var staffs = response.data;

        var $select = $('#staffs');
        var options = $select.data('select2').options;
        $select.html('');

        var res = [];
        for (var i = 0; i < staffs.length; i++) {
          res.push({
            "id": staffs[i].staff_id,
            "text": staffs[i].name
          });
          $select.append('<option value=' + staffs[i].staff_id + ' selected>' + staffs[i].name + '</option>');
        }
        options.data = res;
        $select.select2(options);

        getValuesAndPopulateCalendar();
      })
      .catch(function (error) {
        console.log('populateStaffWithSkills error='+error);
      })
    }

    function getValuesAndPopulateCalendar() {
      var staff_ids = getSelectedMultiSelect2ById('staffs');
      if(staff_ids.length == 0) {
        return;
      }
      var date = vm.currentDate.format('YYYY-MM-DD');
      if (staffs.length === 0) {
        toastr.error('Select skills and staffs first');
      }

      axios.get('{{url('api/getStaffCalendar')}}?staff_ids='+staff_ids+'&date='+date)
      .then(function (response) {
        if (response.data.is_date_blocked === true) {
          $('#div-calendar').html("<div class='alert alert-info no-margin-btm'>Blocked</div>");
          return;
        }
        if (response.data.is_non_working_day === true) {
          $('#div-calendar').html("<div class='alert alert-info no-margin-btm'>Non working day</div>");
          return;
        }

        var html = '<table class="table table-bordered no-margin-btm"><thead><tr><th width="70px"></th>';

        var staffs = response.data.staffs;
        for (var staff_id in staffs) {
          if (staffs.hasOwnProperty(staff_id)) {
            html += "<th>" + staffs[staff_id].name + "</th>";
          }
        }
        html+= "</tr><tbody>";

        var cells = response.data.cells;
        var intervals = response.data.intervals;
        var current_ticket_id = {{ $ticket->ticket_id > 0 ? $ticket->ticket_id : 0 }};

        for(var j = 0; j<intervals.length; j++) {
          var time = intervals[j];
          html += "<tr><td>"+time+"</td>";

          var cols = cells[time];
          for (var staff_id in cols) {
            if (cols.hasOwnProperty(staff_id)) {
              var text = cols[staff_id].ticket_code;

              var ticket_id = cols[staff_id].ticket_id;
              var background = "calendar-empty";
              if (current_ticket_id === ticket_id) {
                background = "calendar-assigned-current-ticket";
              } else if (text !== "") {
                background = "calendar-assigned-other-ticket";
              } else if (typeof selected_cells[staff_id] !== "undefined" && typeof selected_cells[staff_id][date] !== "undefined"){
                if (arrayContains(selected_cells[staff_id][date], time) === true) {
                  background = "calendar-selected";
                }
              }

              if (current_ticket_id !== ticket_id && text !== "") {
                text = "<a href='{{url('ticket/save/')}}/"+ticket_id+"'>"+text+"</a>";
              } else if (text == "") {
                text = staffs[staff_id].name
              }

              html += "<td onclick='selectSlot(this)' class='"+background+"' data-date='"+date+"' data-time='"+time+"' data-staff_id='"+staffs[staff_id].staff_id+"'>"+text+"</td>";
            }
          }
        }
        $('#div-calendar').html(html);
      })
      .catch(function (error) {
        console.log('populateCalendar error='+JSON.stringify(error));
      })
    }

    var vm = new Vue({
      el: "#app",
      data: {
        issues: {!! $ticket->issues !!},
        preferred_slots: {!! $ticket->preferred_slots !!},
        preferred_slots_delete: [],
        currentDate: moment(),
        currentDateFormatted: moment().format('DD MMM YYYY'),
        submit_action: '',
      },computed: {
        yesterday: function() {
          return moment().add(-1, "days");
        },
        tomorrow: function() {
          return moment().add(1, "days");
        }
      },
      methods: {
        previousDate: function() {
          this.currentDate = this.currentDate.add(-1, "days");
          this.currentDateFormatted = this.currentDate.format('DD MMM YYYY');
          $('#date').datepicker("setDate", this.currentDate.startOf('day').toDate());
        },
        nextDate: function() {
          this.currentDate = this.currentDate.add(1, "days");
          this.currentDateFormatted = this.currentDate.format('DD MMM YYYY');
          $('#date').datepicker("setDate", this.currentDate.startOf('day').toDate());
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
        addPreferredSlot: function() {
          var slot = {date: this.currentDate.format('YYYY-MM-DD'), time_start: '', time_end: '', stat:'add'};
          this.preferred_slots.push(slot);
          Vue.nextTick(function() {
            initDatepicker();
          });
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
        draftTicket: function() {
          this.submit_action = "draft";
        },
        updateTicket: function() {
          this.submit_action = "update";
        },
        sendQuotation: function() {
          this.submit_action = "quote";
        },
        openTicket: function() {
          this.submit_action = "open";
        },
        submitForm: function() {
          var validate = validateTicketForm();
          ///console.log('val'+validate);
          if (validate) {
            //console.log(document.getElementById("form-ticket"));
            document.getElementById("form-ticket").submit();
          }
        }
      },
    });

    function pushToCalendarObject(obj, staff_id, date, time) {
      if (typeof obj[staff_id] === "undefined") {
        obj[staff_id] = {};
      }

      if(typeof obj[staff_id][date] === "undefined") {
        obj[staff_id][date] = [];
      }

      var exist = arrayContains(obj[staff_id][date], time);
      if (! exist) {
        obj[staff_id][date].push(time);
      }
    }

    function removeFromCalendarObject(obj, staff_id, date, time) {
      if (typeof obj[staff_id] === "undefined") {
        return;
      }

      if(typeof obj[staff_id][date] === "undefined") {
        return;
      }

      for(var i=0; i<obj[staff_id][date].length; i++) {
        if (obj[staff_id][date][i] === time) {
          obj[staff_id][date].splice(i, 1);
        }
      }
    }

  </script>
@endsection