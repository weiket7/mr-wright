<?php use App\Models\Enums\TicketStat; ?>
<?php use App\Models\Enums\TicketUrgency; ?>
<?php use Carbon\Carbon; ?>

@extends('frontend.template', ['title'=>'tickets'])

@section('content')
  <input type="button" value="DRAFT TICKET" class="more active" onclick="location.href='{{url('ticket/save')}}'">

  @if(count($tickets) > 0 )
  <div class="table-responsive margin-top-20">
    <table class="table table-bordered table-hover">
      <thead>
      <tr>
        <th width="220px" class="bold">Status</th>
        <th width="120px" class="bold">Code</th>
        <th class="bold">Title</th>
        <th class="bold">Category</th>
        <th class="bold">Quoted Price</th>
        <th class="bold">Requested On</th>
      </tr>
      </thead>
      <tbody>
      @foreach($tickets as $ticket)
        <tr>
          <td>
            @if($ticket->stat == TicketStat::Drafted)
              Drafted
            @elseif($ticket->stat == TicketStat::Opened)
              Opened, pending quotation
            @elseif($ticket->stat == TicketStat::Quoted)
              Quoted <button type="button" onclick="location.href='{{url('ticket/view/'.$ticket->ticket_id)}}'" class="btn btn-primary">Respond</button>
            @elseif($ticket->stat == TicketStat::Accepted)
              Accepted, pending completion
            @elseif($ticket->stat == TicketStat::Declined)
              Declined
            @elseif($ticket->stat == TicketStat::Completed)
              Completed, pending invoice
            @elseif($ticket->stat == TicketStat::Invoiced)
              Invoiced <button type="button" onclick="location.href='{{url('ticket/view/'.$ticket->ticket_id)}}'" class="btn btn-primary">Payment</button>
            @elseif($ticket->stat == TicketStat::Paid)
              Paid
            @elseif($ticket->stat == TicketStat::PaymentIndicated)
              Payment Indicated
            @endif
          </td>
          <td>
            @if(in_array($ticket->stat, [TicketStat::Drafted, TicketStat::Opened]))
              <a href="{{url("ticket/save/".$ticket->ticket_id)}}">{{ $ticket->ticket_code }}</a>
            @else
              <a href="{{url("ticket/view/".$ticket->ticket_id)}}">{{ $ticket->ticket_code }}</a>
            @endif
          </td>
          <td>{{  $ticket->title }}</td>
          <td>{{ isset($categories[$ticket->category_id]) ? $categories[$ticket->category_id] : '' }}</td>
          <td>{{ ViewHelper::formatCurrency($ticket->quoted_price) }}</td>
          <td>{{ ViewHelper::formatDate($ticket->requested_on) }}</td>
        </tr>
      @endforeach
      </tbody>
    </table>
    @else
      <div class="alert alert-info" style="margin-top: 20px">
        No tickets
      </div>
    @endif
  </div>
@endsection