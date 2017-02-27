<?php use App\Models\Enums\TicketStat; ?>
<?php use App\Models\Enums\TicketUrgency; ?>
<?php use App\Models\Enums\TicketPriority; ?>

@extends("template")

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
          <li>
            <a href="#tab-myTab" data-toggle="tab">Quotation</a>
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
                      <div class="col-md-9">
                        {{Form::text('title', $ticket->title, ['class'=>'form-control'])}}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Ticket Id</label>
                      <div class="col-md-9">
                        <div class="form-control-static">
                        @if($action == 'update')
                          {{ $ticket->ticket_id }}
                        @else
                          -
                        @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Status</label>
                      <div class="col-md-9">
                        <div class="form-control-static">
                        @if($action == 'create')
                          {{ TicketStat::$values[TicketStat::Open] }}
                        @else
                          {{ TicketStat::$values[$ticket->stat] }}
                        @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
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
                        @if($action == 'create')
                          {{Form::text('requested_on', '', ['class'=>'form-control date-picker', 'placeholder'=>''])}}
                        @else
                          <div class="form-control-static">{{ ViewHelper::formatDate($ticket->requested_on) }}</div>
                        @endif
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
                        <table class="table table-hover table-bordered">
                          <thead>
                          <tr>
                            <th>Image</th>
                            <th>Issue</th>
                            <th>Expected</th>
                          </tr>
                          </thead>
                          <tbody>
                          <tr v-for="image in images">
                            <td>
                              <input type="file">
                            </td>
                            <td><textarea class="form-control" placeholder="Issue"></textarea></td>
                            <td><textarea class="form-control" placeholder="Expected"></textarea></td>
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
                        <button type="submit" class="btn green">Submit</button>
                        <button type="button" class="btn default">Cancel</button>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6"> </div>
                </div>
              </div>
            </form>
          </div>
          <div class="tab-pane fade" id="tab-myTab">
            <table class="table table-bordered">
              <thead>
              <tr>
                <td width="100">Name</td>
                <td>Discounted Price</td>
              </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    var vm = new Vue({
      el: "#app",
      data: {
        images: []
      },
      computed: {
        images_json: function() {
          return JSON.stringify(this.images);
        }
      },
      methods: {
        addImage: function() {
          this.images.push({image:'', 'issue':'', 'expected':''});
        }
      }
    });

    function previewImage(input, targetId) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
      }
    }

    $("#imgInp").change(function(){
      readURL(this);
    });
  </script>
@endsection