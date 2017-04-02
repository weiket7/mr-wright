<?php use App\Models\Enums\TicketStat; ?>
<?php use App\Models\Enums\TicketUrgency; ?>

@extends("template")

@section("content")
  <div class="row">
    <div class="col-md-12">
      <h1 class="page-title">Invoice</h1>
    </div>
  </div>

  <div class="portlet light bordered">
    <div class="portlet-body">
      <div class="alert alert-info">Showing completed tickets</div>

      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
          <tr>
            <th width="80px">Status</th>
            <th width="120px">Code</ th>
            <th>Title</th>
            <th>Category</th>
            <th>Quoted Price</th>
            <th>Completed By</th>
          </tr>
          </thead>
          <tbody>
          @foreach($tickets as $ticket)
            <tr>
              <td>{{  TicketStat::$values[$ticket->stat]  }}</td>
              <td>{{  $ticket->ticket_code }}</td>
              <td><a href="{{url("ticket/view/".$ticket->ticket_id)}}">{{ $ticket->title }}</a></td>
              <td>{{ isset($categories[$ticket->category_id]) ? $categories[$ticket->category_id] : '' }}</td>
              <td>{{ $ticket->quoted_price }}</td>
              <td>{{ $ticket->completed_by }} on {{ ViewHelper::formatDate($ticket->completed_on) }}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection