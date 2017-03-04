<?php use App\Models\Enums\TicketStat; ?>
<?php use App\Models\Enums\TicketUrgency; ?>
<?php use App\Models\Enums\TicketPriority; ?>

@extends("template")

@section('content')
  <h1 class="page-title" xmlns:v-on="http://www.w3.org/1999/xhtml">
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
          <!--<li>
            <a href="#tab-quotation" data-toggle="tab">Quotation</a>
          </li>-->
        </ul>
        <div class="tab-content no-space">
          <div class="tab-pane fade active in" id="tab-general">
            <form action="" method="post" class="form-horizontal">
              {!! csrf_field() !!}
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

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label col-md-3">Opened By</label>
                        <div class="col-md-9">
                          <div class="form-control-static">{{ $ticket->opened_by }} on {{ ViewHelper::getNowFormatted() }}</div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      @if($ticket->stat == TicketStat::Quoted)
                      <div class="form-group">
                        <label class="control-label col-md-3">Quoted By</label>
                        <div class="col-md-9">
                          <div class="form-control-static">{{ $ticket->quotation->quoted_by }} on {{ ViewHelper::formatDate($ticket->quotation->quoted_on) }}</div>
                        </div>
                      </div>
                      @endif
                    </div>
                  </div>
                @endif

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Company</label>
                      <div class="col-md-9">
                        {{Form::select('company_id', $companies, $ticket->company_id, ['class'=>'form-control', 'placeholder'=>''])}}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Category</label>
                      <div class="col-md-9">
                        {{Form::select('category_id', $categories, $ticket->category_id, ['class'=>'form-control', 'placeholder'=>''])}}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Office</label>
                      <div class="col-md-9">
                        {{Form::select('office_id', $companies, $ticket->office_id, ['class'=>'form-control', 'placeholder'=>''])}}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Urgency</label>
                      <div class="col-md-9">
                        {{Form::select('urgency', TicketUrgency::$values, $ticket->urgency, ['class'=>'form-control', 'placeholder'=>''])}}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Requested By</label>
                      <div class="col-md-9">
                        {{Form::select('requested_by', $companies, $ticket->requested_by, ['class'=>'form-control', 'placeholder'=>''])}}
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
                        {{Form::textarea('requester_desc', $ticket->requester_desc, ['class'=>'form-control', 'rows'=>5])}}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Operator Description</label>
                      <div class="col-md-9">
                        {{Form::textarea('operator_desc', $ticket->operator_desc, ['class'=>'form-control', 'rows'=>5])}}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Images</label>
                  <div class="col-md-10">
                    <input type="hidden" v-bind:value="images_count">

                    <table class="table table-hover table-bordered no-margin-btm">
                      <thead>
                      <tr>
                        <th>Image</th>
                        <th>Issue</th>
                        <th>Expected</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr v-for="(image, index) in images">
                        <td>
                          <div v-bind:id="'preview-image' + index"></div>
                          <input type="file" v-bind:name="'image' + index" v-on:change="previewImage(index,$event)">
                        </td>
                        <td><textarea v-bind:name="'issue' + index" class="form-control" placeholder="Issue"></textarea></td>
                        <td><textarea v-bind:name="'expected' + index"  class="form-control" placeholder="Expected"></textarea></td>
                      </tr>
                      </tbody>
                      <tfoot>
                      <tr>
                        <td colspan="3">
                          <div class="text-center">
                            <button type="button" class="btn blue" @click='addImage'>Add</button>
                          </div>
                        </td>
                      </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>


                {!! csrf_field() !!}
                <div class="form-group">
                  <label class="control-label col-md-2">Quoted Price</label>
                  <div class="col-md-10">
                    {{Form::text('quoted_price', $ticket->quotation->quoted_price, ['class'=>'form-control'])}}
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-2">Preferred Slots</label>
                  <div class="col-md-10">
                    <table class="table table-hover table-bordered no-margin-btm">
                      <thead>
                      <tr>
                        <th width="210px">Date</th>
                        <th>Time</th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach($ticket->preferred_datetimes as $p)
                        <tr>
                          <td>
                            {{ViewHelper::formatDate($p->date_from)}}
                            to {{ViewHelper::formatDate($p->date_to)}}
                          </td>
                          <td>
                            {{ViewHelper::formatTime($p->time_from)}}
                            to {{ViewHelper::formatTime($p->time_to)}}
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-2">Skills</label>
                  <div class="col-md-10">
                    <div class="mt-checkbox-inline">
                      @foreach($skills as $skill)
                        <label class="mt-checkbox mt-checkbox-outline">
                          <input type="checkbox" value="{{$skill}}" name="skills"/> {{ $skill }}
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
                  <label for="" class="control-label col-md-2" id="assignments">Calendar</label>
                  <div class="col-md-10">
                    <div id="calendar"></div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-2">Quotation Description</label>
                  <div class="col-md-10">
                    {{Form::textarea('quotation_desc', $ticket->quotation->quotation_desc, ['class'=>'form-control', 'rows'=>5])}}
                  </div>
                </div>


              </div>

              <div class="form-actions">
                <div class="row">
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-offset-3 col-md-9">
                        @if(in_array($ticket->stat, [null, TicketStat::Opened]))
                          <button type="submit" name="submit" class="btn green" value="{{ ucfirst($action) }} Ticket">
                            {{ ucfirst($action) }} Ticket
                          </button>
                        @endif
                        @if($ticket->stat == TicketStat::Opened)
                          <button type="submit" name="submit" class="btn blue" value="Send Quotation">
                            Send Quotation
                          </button>
                        @endif
                          @if($ticket->stat == TicketStat::Accepted)
                            <button type="submit" name="submit" class="btn blue" value="Complete">
                              Complete
                            </button>
                          @endif
                        @if($ticket->stat == TicketStat::Quoted)
                          <div class="alert alert-info">
                            Quotation has been sent. Waiting for customer's response.
                          </div>
                        @endif

                      </div>
                    </div>
                  </div>
                  <div class="col-md-6"> </div>
                </div>
              </div>
            </form>
          </div>
          <!--<div class="tab-pane fade" id="tab-quotation">
          </div>-->

        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>

    $(document).ready(function() {
      //http://stackoverflow.com/questions/29618382/disable-dropdown-opening-on-select2-clear
      $("#staffs").select2({
        allowClear: true,
        placeholder: "Select"
      }).on('select2:unselecting', function() { //unselect prevent open dropdown
        $(this).data('unselecting', true);
      }).on('select2:opening', function(e) {
        if ($(this).data('unselecting')) {
          $(this).removeData('unselecting');
          e.preventDefault();
        }
      }).on("select2:select select2:unselect", function(e) {
        var selected_staffs = getSelectedMultiSelect2ById('staffs');
        populateCalendar(selected_staffs);
      });


      $("input[name='skills']").click(function() {
        var selected_skills = getSelectedCheckboxesByName('skills');
        getStaffWithSkills(selected_skills);
      });

      $("#date").on('changeDate', function() {
        getStaffsAndPopulateCalendar();
      });

    });

    function quotationTab() {
      location.href += '#tab-quotation';
      $('a[href="#tab-quotation"]').tab('show');
    }
    
    var selectedCells = {};

    function selectSlot(cell) {
      var time = $(cell).attr('data-time');
      var name = $(cell).attr('data-name');

      if ($(cell).hasClass('calendar-selected')) {
        $(cell).removeClass('calendar-selected');
        removeFromObject(selectedCells, name, time);
      } else {
        pushToObject(selectedCells, name, time);
        $(cell).addClass('calendar-selected');
      }

      //TODO sort times
      $("#assignments").text(JSON.stringify(selectedCells));
    }

    function getStaffWithSkills(skills) {
      axios.get('{{url('api/getStaffWithSkills')}}?skills='+skills)
      .then(function (response) {
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

        var selected_staffs = [];
        for(var j=0; j<staffs.length; j++) {
          selected_staffs.push(staffs[j].staff_id);
        }
        populateCalendar(selected_staffs);
      })
      .catch(function (error) {
        console.log('getStaffWithSkills error='+error);
      })
    }

    function getStaffsAndPopulateCalendar() {
      var selected_staffs = getSelectedMultiSelect2ById('staffs');
      if (selected_staffs.length === 0) {
        toastr.error('Select skills and staffs first');
      }
      populateCalendar(selected_staffs);
    }

    function populateCalendar(staffs) {
      //console.log('selected_staffs='+selected_staffs);
      axios.get('{{url('api/getStaffCalendar')}}?staffs='+staffs+'&date='+vm.currentDate.format('YYYY-MM-DD'))
      .then(function (response) {
        if (response.data.is_date_blocked) {
          $('#calendar').html("<label class='control-label'>Date is blocked</label>");
          return;
        }

        var html = '<table class="table table-bordered no-margin-btm"><thead><tr><th width="80px"></th>';

        var columns = response.data.columns;
        for(var i = 0; i<columns.length; i++) {
          html += "<th>" + columns[i] + "</th>";
        }
        html+= "</tr><tbody>";

        var rows = response.data.rows;
        var intervals = response.data.intervals;

        for(var j = 0; j<intervals.length; j++) {
          var time = intervals[j];
          html += "<tr><td>"+time+"</td>";
          //console.log(rows[time]);

          for(var k=0; k<rows[time].length; k++) {
            html += "<td onclick='selectSlot(this)' data-time="+time+" data-name="+columns[k]+">"+rows[time][k].text+"</td>";
          }
        }
        $('#calendar').html(html);
      })
      .catch(function (error) {
        console.log('populateCalendar error');
      })
    }

    var vm = new Vue({
      el: "#app",
      data: {
        images: [],
        currentDate: moment(),
        currentDateFormatted: moment().format('DD MMM YYYY')
      },
      computed: {
        images_count: function() {
          return this.images.length;
        },
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
        addImage: function() {
          this.images.push({image:'', 'issue':'', 'expected':''});
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
          return value.format('DD MMM YYYY');
        }
      }
    });
  </script>
@endsection