<?php use App\Models\Enums\TicketStat; ?>
<?php use App\Models\Enums\TicketUrgency; ?>
<?php use App\Models\Enums\TicketPriority; ?>

@extends("template")

@section('content')
  <h1 class="page-title">
    {{ucfirst($action)}} Ticket
  </h1>

  <div class="portlet light bordered">
    <div class="portlet-body form">
      <div class="tabbable">
        <ul class="nav nav-tabs">
          <li class="active">
            <a href="#tab-general" data-toggle="tab">
              General </a>
          </li>
          <li>
            <a href="#tab-myTab" data-toggle="tab">Tab</a>
          </li>
        </ul>
        <div class="tab-content no-space">
          <div class="tab-pane fade active in" id="tab-general">
            <form action="" method="post" class="form-horizontal">
              {!! csrf_field() !!}
              <div class="form-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Ticket Id</label>
                      <div class="col-md-9">
                        {{Form::text('name', $ticket->name, ['class'=>'form-control'])}}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Status</label>
                      <div class="col-md-9">
                        {{Form::select('stat', TicketStat::$values, $ticket->stat, ['class'=>'form-control', 'placeholder'=>''])}}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-md-3">Category</label>
                      <div class="col-md-9">
                        {{Form::text('name', $ticket->name, ['class'=>'form-control'])}}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Status</label>
                      <div class="col-md-9">
                        {{Form::select('stat', TicketStat::$values, $ticket->stat, ['class'=>'form-control', 'placeholder'=>''])}}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Company</label>
                      <div class="col-md-9">
                        {{Form::select('stat', $companies, $ticket->stat, ['class'=>'form-control', 'placeholder'=>''])}}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Urgency</label>
                      <div class="col-md-9">
                        {{Form::select('stat', TicketUrgency::$values, $ticket->urgency, ['class'=>'form-control', 'placeholder'=>''])}}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Office</label>
                      <div class="col-md-9">
                        {{Form::select('stat', $companies, $ticket->stat, ['class'=>'form-control', 'placeholder'=>''])}}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Priority</label>
                      <div class="col-md-9">
                        {{Form::select('stat', TicketPriority::$values, $ticket->priority, ['class'=>'form-control', 'placeholder'=>''])}}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Requester</label>
                      <div class="col-md-9">
                        {{Form::select('stat', $companies, $ticket->stat, ['class'=>'form-control', 'placeholder'=>''])}}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Requested On</label>
                      <div class="col-md-9">
                        {{Form::text('requested_on', $ticket->requested_on, ['class'=>'form-control', 'placeholder'=>''])}}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label col-md-2">Images</label>
                      <div class="col-md-10">
                        <table class="table table-hover table-bordered">
                          <thead>
                          <tr>
                            <th>Image</th>
                            <th>Problem</th>
                            <th>Description</th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($ticket->images as $i)
                            <tr>
                              <td>
                                <img src="{{asset('images/'.$i->image)}}" class="ticket-image"><br>
                                <input type="file">
                              </td>
                              <td><textarea class="form-control"></textarea></td>
                              <td><textarea class="form-control"></textarea></td>
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