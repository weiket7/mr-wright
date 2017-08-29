<?php use App\Models\Enums\TicketStat; ?>
<?php use App\Models\Enums\TicketUrgency; ?>
<?php use App\Models\Enums\TicketPriority; ?>

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
                  <div class="col-md-10 form-control-static">
                    {{ $ticket->title }}
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Ticket Code</label>
                      <div class="col-md-9 form-control-static">
                        {{ $ticket->ticket_code }}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Status</label>
                      <div class="col-md-9">
                        <div class="form-control-static">
                          {{ TicketStat::$values[$ticket->stat] }}
                          @if(in_array($ticket->stat, [TicketStat::Accepted, TicketStat::Declined]) && $ticket->accept_decline_reason)
                            - {{ $ticket->accept_decline_reason }}
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @if($ticket->payment_method)
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label col-md-3">Payment Method</label>
                        <label class="col-md-9 form-control-static">
                          {{ $payment_methods[$ticket->payment_method]}}
                        </label>
                      </div>
                    </div>
                    @if($ticket->ref_no)
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label col-md-3">Ref No</label>
                          <label class="col-md-9 form-control-static">
                            {{ $ticket->ref_no }}
                          </label>
                        </div>
                      </div>
                    @endif
                  </div>
                @endif
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Category</label>
                      <label class="col-md-9 form-control-static">
                        {{ $ticket->category_name }}
                      </label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Urgency</label>
                      <label class="col-md-9 form-control-static">
                        {{ \App\Models\Enums\TicketUrgency::$values[$ticket->urgency] }}
                      </label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Company</label>
                      <label class="col-md-9 form-control-static">
                        {{ $ticket->company_name }}
                      </label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Office</label>
                      <label class="col-md-9 form-control-static">
                        {{ $ticket->office_name }}
                      </label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Office Address</label>
                      <label class="col-md-9 form-control-static">
                        {{ $ticket->office_addr }}
                      </label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Office Postal</label>
                      <label class="col-md-9 form-control-static">
                        {{ $ticket->office_postal }}
                      </label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Requested By</label>
                      <label class="col-md-9 form-control-static">
                        {{ $ticket->requested_by }} on {{ ViewHelper::formatDate($ticket->requested_on) }}
                      </label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Contact</label>
                      <label class="col-md-9 form-control-static">
                        {{ $ticket->requester_mobile }}<br>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Requester Description</label>
                      <label class="col-md-9 form-control-static">
                        {{ $ticket->requester_desc }}
                      </label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Operator Description</label>
                      <label class="col-md-9 form-control-static">
                        {{ $ticket->operator_desc }}
                      </label>
                    </div>
                  </div>
                </div>
                @if(Auth::user()->type == \App\Models\Enums\UserType::Operator)
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label col-md-3">Quoted Price</label>
                        <label class="col-md-9 form-control-static">
                          {{ ViewHelper::formatCurrency($ticket->quoted_price) }}
                          {{ Form::text('quoted_price', '', ['id'=>'txt-quoted-price', 'class'=>'form-control', 'style'=>'display:none']) }}
                          @if($ticket->stat == TicketStat::Completed)
                            <button type='button' id='btn-adjust' class="btn btn-xs blue" >Adjust</button>
                          @endif
                        </label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label col-md-3">Quotation Description</label>
                        <label class="col-md-9 form-control-static">
                          {{ $ticket->quotation_desc }}
                        </label>
                      </div>
                    </div>
                  </div>
                @endif

                <div class="form-group">
                  <label class="control-label col-md-2">Issues</label>
                  <div class="col-md-10">
                    <table class="table table-bordered no-margin-btm table-responsive">
                      <thead>
                      <tr>
                        <th width="255px">Image / Video</th>
                        <th>Issue</th>
                        <th>Expected Outcome</th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach($ticket->issues as $issue)
                        <tr>
                          <td>
                            <img src="{{asset('assets/images/tickets/'.$issue->image)}}" class="ticket-image"/>
                          </td>
                          <td>
                            {{ $issue->issue_desc }}
                          </td>
                          <td>
                            {{ $issue->expected_desc }}
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>

                <!--TODO-->
                @if(Auth::user()->type == \App\Models\Enums\UserType::Operator)
                  <div class="form-group">
                    <label class="control-label col-md-2">Preferred Slots</label>
                    <div class="col-md-10">
                      <table class="table table-bordered no-margin-btm table-responsive">
                        <thead>
                        <tr>
                          <th width="120px">Date</th>
                          <th>Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ticket->preferred_slots as $slot)
                          <tr>
                            <td>
                              {{ ViewHelper::formatDate($slot->date)}}
                            </td>
                            <td>
                              {{ ViewHelper::formatTime($slot->time_start) }} to {{ ViewHelper::formatTime($slot->time_end) }}
                            </td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                @endif

                <div class="form-group">
                  <label class="control-label col-md-2">Staff Assignments</label>
                  <div class="col-md-10">
                    <table class="table table-bordered no-margin-btm table-responsive">
                      <thead>
                      <tr>
                        <th width="120px">Date</th>
                        <th>Staff</th>
                        <th>Time</th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach($ticket->staff_assignments as $date => $assignments)
                        @foreach($assignments as $a)
                          <tr>
                            <td>{{ ViewHelper::formatDate($date) }}</td>
                            <td>{{ $a->staff_name }}</td>
                            <td>{{ ViewHelper::formatTime($a->time_start) }} to {{ ViewHelper::formatTime($a->time_end) }}</td>
                          </tr>
                        @endforeach
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-2">One time passwords</label>
                  <div class="col-md-10">
                    <table class="table table-bordered no-margin-btm table-responsive">
                      <thead>
                      <tr>
                        <th width="120px">Date</th>
                        <th width="200px">First OTP</th>
                        <th>Second OTP</th>
                      </tr>
                      </thead>
                      <tbody>
                      @if(ViewHelper::hasAccess('ticket_view_otp'))
                        @foreach($ticket->otps as $otp)
                          <tr>
                            <td>{{ ViewHelper::formatDate($otp->date) }}</td>
                            <td>{{ $otp->first_otp }}</td>
                            <td>{{ $otp->second_otp }}</td>
                          </tr>
                        @endforeach
                      @endif
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
                            <div>
                              <textarea name="accept_decline_reason" title="" class="form-control textarea-ticket-submit" placeholder="[Optional] Please share with us the reason for accepting or declining">
                              </textarea>
                            </div>

                            <div>
                              <button type="submit" name="submit" class="btn blue" value="Accept">
                                Accept
                              </button>
                              <button type="submit" name="submit" class="btn blue" value="Decline">
                                Decline
                              </button>
                            </div>
                          @elseif($ticket->stat == TicketStat::Accepted && ViewHelper::hasAccess('ticket_complete'))
                            <div><button type="submit" name="submit" class="btn blue" value="Complete">
                                Complete
                              </button></div>
                          @elseif($ticket->stat == TicketStat::Completed && ViewHelper::hasAccess('ticket_invoice'))
                            <div><button type="submit" name="submit" class="btn blue" value="Send Invoice">
                                Send Invoice
                              </button></div>
                          @elseif($ticket->stat == TicketStat::Invoiced && ViewHelper::hasAccess('ticket_pay'))
                            <?php $payment_method_values = array_keys($payment_methods->toArray()); ?>
                            <div class="mt-radio-list">
                              @if(in_array('R', $payment_method_values))
                                <label class="mt-radio mt-radio-outline">
                                  <input type="radio" name="payment_method" value="R" @click="selectPaymentMethod('R')"> Credit Card
                                  <span></span>
                                </label>
                              @endif
                              @if(in_array('C', $payment_method_values))
                                <label class="mt-radio mt-radio-outline">
                                  <input type="radio" name="payment_method" value="C" @click="selectPaymentMethod('C')"> Cash
                                  <span></span>
                                </label>
                              @endif
                              @if(in_array('N', $payment_method_values))
                                <label class="mt-radio mt-radio-outline">
                                  <input type="radio" name="payment_method" value="N" @click="selectPaymentMethod('N')"> NETS
                                  <span></span>
                                </label>
                              @endif
                              @if(in_array('B', $payment_method_values))
                                <label class="mt-radio mt-radio-outline">
                                  <input type="radio" name="payment_method" value="B" @click="selectPaymentMethod('B')"> Bank Transfer
                                  <span></span>
                                </label>
                              @endif
                              @if(in_array('Q', $payment_method_values))
                                <label class="mt-radio mt-radio-outline">
                                  <input type="radio" name="payment_method" value="Q" @click="selectPaymentMethod('Q')"> Cheque
                                  <span></span>
                                </label>
                              @endif
                              <input type="text" name="ref_no" v-show="showRefNo" class="form-control" placeholder="Ref No">
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
            @include('admin.ticket.history', ['ticket'=>$ticket])
          </div>

        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    $(document).ready(function(){
      $("#btn-adjust").click(function() {
        $("#txt-quoted-price").show();
      });
    });

    var vm = new Vue({
      el: "#app",
      data: {
        showRefNo: false
      },
      methods: {
        selectPaymentMethod: function(pm) {
          this.showRefNo = pm == 'B' || pm == 'Q';
        }
      },
    });
  </script>
@endsection