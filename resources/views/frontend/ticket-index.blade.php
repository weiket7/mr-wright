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
            {{ ViewHelper::ticketStatFrontend($ticket) }}
            @if($ticket->stat == TicketStat::Quoted || $ticket->stat == TicketStat::Invoiced)
              <button type="button" onclick="location.href='{{url('ticket/view/'.$ticket->ticket_id)}}'" class="btn btn-primary">
                {{ $ticket->stat == TicketStat::Quoted ? "Respond" : "Payment" }}
              </button>
            @endif
          </td>
          <td>
            <a href="{{ ViewHelper::ticketLinkFrontend($ticket) }}">{{ $ticket->ticket_code }}</a>
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