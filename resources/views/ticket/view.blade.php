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
            <a href="#tab-history" data-toggle="tab">History</a>
          </li>
        </ul>
        <div class="tab-content no-space">
          <div class="tab-pane fade active in" id="tab-general">
            <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
              {!! csrf_field() !!}
              <div class="form-body">
                <div class="form-group">
                  <label class="control-label col-md-2">Title</label>
                  <div class="col-md-10">
                    <div class="form-control-static">
                      {{ $ticket->title }}
                    </div>
                  </div>
                </div>
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
                      <label class="control-label col-md-3">Company</label>
                      <div class="col-md-9">
                        <div class="form-control-static">
                          {{ $ticket->company->name }}
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Category</label>
                      <div class="col-md-9">
                        <div class="form-control-static">
                          {{ $ticket->category->name }}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Office</label>
                      <div class="col-md-9">
                        <div class="form-control-static">
                          {{ $ticket->office->name }}
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Urgency</label>
                      <div class="col-md-9">
                        <div class="form-control-static">
                          @if($ticket->urgency)
                            {{  TicketUrgency::$values[$ticket->urgency] }}
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Requested By</label>
                      <div class="col-md-9">
                        <div class="form-control-static">
                          {{ $ticket->requested_by }}
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Requested On</label>
                      <div class="col-md-9">
                        <div class="form-control-static">
                          {{ ViewHelper::formatDate($ticket->requested_on) }}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Requester Description</label>
                      <div class="col-md-9">
                        <div class="form-control-static">
                          {{ $ticket->requester_desc }}
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Operator Description</label>
                      <div class="col-md-9">
                        <div class="form-control-static">
                          {{ $ticket->operator_desc }}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Quoted Price</label>
                      <div class="col-md-9">
                        <div class="form-control-static">
                          {{ ViewHelper::formatCurrency($ticket->quoted_price) }}
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Quotation Description</label>
                      <div class="col-md-9">
                        <div class="form-control-static">
                          {{ $ticket->quotation_desc }}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Issues</label>
                  <div class="col-md-10">
                    <input type="hidden" name="issues_count" v-bind:value="issues.length">

                    <table class="table table-bordered no-margin-btm">
                      <thead>
                      <tr>
                        <th width="255px">Image</th>
                        <th>Issue</th>
                        <th>Expected</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr v-for="(issue, index) in issues" v-bind:class="'row-'+issue.stat">
                        <td>
                          <div v-bind:id="'preview-image' + index">
                            <img :src="'{{asset('images/tickets')}}/'+ issue.image " v-if="issue.image" class="ticket-image"/>
                          </div>
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
                  <label class="control-label col-md-2">Preferred Slots</label>
                  <div class="col-md-10">
                    <input type="hidden" name="preferred_slots_count" v-bind:value="preferred_slots.length">

                    <table class="table table-bordered no-margin-btm">
                      <thead>
                      <tr>
                        <th width="120px">Date</th>
                        <th>Time</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr v-for="(slot, index) in preferred_slots" v-bind:class="'row-'+slot.stat">
                        <td>
                          @{{ slot.date | formatDate }}
                        </td>
                        <td>
                          @{{ slot.time_start | formatTime }} to @{{ slot.time_end | formatTime }}
                        </td>
                      </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-2">Staff Assignments</label>
                  <div class="col-md-10">
                    <table class="table table-bordered no-margin-btm">
                      <thead>
                      <tr>
                        <th width="120px">Date</th>
                        <th width="200px">Staff</th>
                        <th>Time</th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach($ticket->staff_assignments as $date => $assignments)
                        @foreach($assignments as $a)
                          <tr>
                            <td>{{ ViewHelper::formatDate($date) }}</td>
                            <td>{{ $a->name }}</td>
                            <td>{{ ViewHelper::formatTime($a->time_start) }} to {{ ViewHelper::formatTime($a->time_end) }}</td>
                          </tr>
                      @endforeach
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="form-actions">
                <div class="row">
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-offset-3 col-md-9">
                        <div>
                          @if($ticket->stat == TicketStat::Quoted && ViewHelper::hasAccess('ticket_respond'))
                            @if($action == 'view' || $action == 'decline')
                              <div>
                                <textarea name="decline_reason" title="" class="form-control txt-decline-reason" placeholder="Please share with us the reason for declining">
                                </textarea>
                              </div>
                            @endif

                            @if($action == "accept" || $action == "decline") <!--show 1 button when ticket/accept or ticket/decline-->
                              <div><button type="submit" name="submit" class="btn blue" value="{{ ucfirst($action) }}">
                                {{ ucfirst($action) }}
                              </button></div>
                            @else <!--show 2 buttons when operator ticket/accept or ticket/decline-->
                              <div><button type="submit" name="submit" class="btn blue" value="Accept">
                                Accept
                              </button>
                              <button type="submit" name="submit" class="btn blue" value="Decline">
                                Decline
                              </button></div>
                            @endif
                          @elseif($ticket->stat == TicketStat::Accepted && ViewHelper::hasAccess('ticket_complete'))
                            <div><button type="submit" name="submit" class="btn blue" value="Complete">
                              Complete
                            </button></div>
                          @elseif($ticket->stat == TicketStat::Completed && ViewHelper::hasAccess('ticket_invoice'))
                            <div><button type="submit" name="submit" class="btn blue" value="Send Invoice">
                              Send Invoice
                            </button></div>
                          @elseif($ticket->stat == TicketStat::Invoiced && ViewHelper::hasAccess('ticket_pay'))
                            <div class="mt-radio-list">
                              <label class="mt-radio mt-radio-outline">
                                <input type="radio" name="payment_method" value="option2"> Credit Card
                                <span></span>
                              </label>
                              <label class="mt-radio mt-radio-outline">
                                <input type="radio" name="payment_method" value="option2"> Cash
                                <span></span>
                              </label>
                              <label class="mt-radio mt-radio-outline">
                                <input type="radio" name="payment_method" value="option1"> Bank Transfer
                                <span></span>
                              </label>
                              <input type="text" name="bank_ref_no" class="form-control">
                              <label class="mt-radio mt-radio-outline">
                                <input type="radio" name="payment_method" value="option2"> Cheque
                                <span></span>
                              </label>
                              <input type="text" name="cheque_no" class="form-control">
                            </div>
                            <br>
                            <div><button type="submit" name="submit" class="btn blue" value="Paid">
                              Paid
                            </button></div>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6"> </div>
                </div>
              </div>
            </form>
          </div>
          <div class="tab-pane fade" id="tab-history">
            <ul class="list-group">
              <?php $history = [];
              if ($ticket->paid_by)
                $history[] = "Paid by ".$ticket->paid_by." on " . ViewHelper::formatDateTime($ticket->paid_on);
              if ($ticket->invoiced_by)
                $history[] = "Invoiced by ".$ticket->invoiced_by." on " . ViewHelper::formatDateTime($ticket->invoiced_on);
              if ($ticket->completed_by)
                $history[] = "Completed by ".$ticket->completed_by." on " . ViewHelper::formatDateTime($ticket->completed_on);
              if ($ticket->declined_by)
                $history[] = "Declined by ".$ticket->declined_by." on " . ViewHelper::formatDateTime($ticket->declined_on);
              if ($ticket->accepted_by)
                $history[] = "Accepted by ".$ticket->accepted_by." on " . ViewHelper::formatDateTime($ticket->accepted_on);
              if ($ticket->quoted_by)
                $history[] = "Quoted by ".$ticket->quoted_by." on " . ViewHelper::formatDateTime($ticket->quoted_on);
              if ($ticket->opened_by)
                $history[] = "Opened by ".$ticket->opened_by." on " . ViewHelper::formatDateTime($ticket->opened_on);
              if ($ticket->drafted_by)
                $history[] = "Drafted by ".$ticket->drafted_by." on " . ViewHelper::formatDateTime($ticket->drafted_on);
              ?>
              @foreach($history as $h)
                <li class="list-group-item"> {{ $h }} </li>
              @endforeach
            </ul>
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
        issues: {!! $ticket->issues !!},
        preferred_slots: {!! $ticket->preferred_slots !!},
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
          return value.format('HH:mm');
        }
      }
    });
  </script>
@endsection