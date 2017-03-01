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
          <li>
            <a href="#tab-quotation" data-toggle="tab">Quotation</a>
          </li>
        </ul>
        <div class="tab-content no-space">
          <div class="tab-pane fade active in" id="tab-general">
            <form action="" method="post" class="form-horizontal">
              {!! csrf_field() !!}
              <div class="form-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label col-md-2">Title</label>
                      <div class="col-md-10">
                        {{Form::text('title', $ticket->title, ['class'=>'form-control'])}}
                      </div>
                    </div>
                  </div>
                </div>
                @if($action == 'update')
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
                      <label class="control-label col-md-3">Company</label>
                      <div class="col-md-9">
                        {{Form::select('company_id', $companies, $ticket->stat, ['class'=>'form-control', 'placeholder'=>''])}}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Category</label>
                      <div class="col-md-9">
                        {{Form::select('category_id', $categories, $ticket->stat, ['class'=>'form-control', 'placeholder'=>''])}}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Office</label>
                      <div class="col-md-9">
                        {{Form::select('office_id', $companies, $ticket->stat, ['class'=>'form-control', 'placeholder'=>''])}}
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
                        {{Form::select('requested_by', $companies, $ticket->stat, ['class'=>'form-control', 'placeholder'=>''])}}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Requested On</label>
                      <div class="col-md-9">
                        {{Form::text('requested_on', ViewHelper::formatDate($ticket->requested_on), ['class'=>'form-control date-picker', 'placeholder'=>''])}}
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
                @if($action == 'update')
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label col-md-3">Opened By</label>
                        <div class="col-md-9">
                          <div class="form-control-static">{{ $ticket->opened_by }}</div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label col-md-3">Opened On</label>
                        <div class="col-md-9">
                          <div class="form-control-static">{{ ViewHelper::getNowFormatted() }}</div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label col-md-2">Images</label>
                      <div class="col-md-10">
                        <input type="hidden" v-bind:value="images_count">

                        <table class="table table-hover table-bordered">
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
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label col-md-2">Preferred Date Time</label>
                      <div class="col-md-10">
                        <table class="table table-hover table-bordered">
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
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label col-md-2">Staff Assignment</label>
                      <div class="col-md-10">
                        <table class="table table-hover table-bordered">
                          <thead>
                          <tr>
                            <th>Staff</th>
                            <th width="210px">Date</th>
                            <th>Time</th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($ticket->staff_assignments as $a)
                            <tr>
                              <td>{{$a->staff_id}}</td>
                              <td>
                                {{ViewHelper::formatDate($a->date_from)}}
                                to {{ViewHelper::formatDate($a->date_to)}}
                              </td>
                              <td>
                                {{ViewHelper::formatTime($a->time_from)}}
                                to {{ViewHelper::formatTime($a->time_to)}}
                              </td>
                            </tr>
                          @endforeach
                          </tbody>
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
                        <button type="submit" class="btn green">
                          {{ ucfirst($action) }}
                        </button>
                        <button type="button" class="btn blue" onclick="quotationTab()">
                          Create Quotation
                        </button>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6"> </div>
                </div>
              </div>
            </form>
          </div>
          <div class="tab-pane fade" id="tab-quotation">
            @include('ticket/quotation')
          </div>

        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    function quotationTab() {
      location.href += '#tab-quotation';
      $('a[href="#tab-quotation"]').tab('show');
    }

    var vm = new Vue({
      el: "#app",
      data: {
        images: [],
        selected_skills: [],
        calendar_columns: [],
        calendar_rows: [],
        calendar_intervals: [],
      },
      computed: {
        images_count: function() {
          return this.images.length;
        }
      },
      watch: {
        selected_skills: function(n, o) {
          this.getStaffCalendar();
          console.log(n + ' ' + o);
        }
      },
      methods: {
        getStaffCalendar: _.debounce(
          function () {
            var vm = this
            axios.get('{{url('api/getStaffCalendar')}}?selected_skills='+this.selected_skills)
            .then(function (response) {
              vm.calendar_columns = response.data.columns;
              vm.calendar_rows = response.data.rows;
              vm.calendar_intervals = response.data.intervals;
              console.log('columns = ' + response.data.columns);
              console.log('rows = ' + response.data.rows);
              //console.log('Tom = ' + response.data.rows.Tom);
              //console.log('Tom.10:30 = ' + response.data.rows.Tom['10:30']);
              //console.log('Tom.10:30.text = ' + response.data.rows.Tom['10:30'].text);
            })
            .catch(function (error) {
              alert('ERROR!');
            })
          },
          // This is the number of milliseconds we wait for the
          // user to stop typing.
          300
        ),
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
      }
    });
  </script>

  @section('script-quotation')

  @show
@endsection