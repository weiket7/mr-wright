<?php use App\Models\Enums\TicketStat; ?>

@extends("admin.template")

@section("content")
  <div class="row">
    <div class="col-xs-6">
      <h1 class="page-title">
        Tickets
      </h1>
    </div>
    <div class="col-xs-6 text-right">
      @if(ViewHelper::hasAccess('ticket_draft'))
        <button type="button" class="btn blue" onclick="location.href='{{url('admin/ticket/save')}}'">Create</button>
      @endif
    </div>
  </div>

  <div class="portlet light bordered">
    <div class="portlet-body">
      <form action="" method="post">
        {!! csrf_field() !!}
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
            <tr>
              <th class="search-th-stat">Status</th>
              <th class="search-th-txt">Code</th>
              <th>Title</th>
              <th>Show top</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>{!! Form::select('stat', TicketStat::$values, '', ['class'=>'form-control search-stat', 'placeholder'=>'']) !!}</td>
              <td>{!! Form::text('ticket_code', '', ['class'=>'form-control search-txt']) !!}</td>
              <td>{!! Form::text('title', '', ['class'=>'form-control search-txt']) !!}</td>
              <td>{!! Form::text('limit', 100, ['class'=>'form-control search-txt']) !!}</td>
            </tr>
            </tbody>
          </table>
        </div>
        
        <div class="row">
          <div class="col-md-12 text-center">
            <button type="submit" name="submit" class="btn blue" value="Search">Search</button>
            <button type="reset" class="btn green">Clear</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  
  <div class="portlet light bordered">
    <div class="portlet-body">
      @if(Session::has('search_result'))
        <div class="alert alert-success ">
          {{ Session::get('search_result') }}
        </div>
      @endif
      
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
          <tr>
            <th width="80px">Status</th>
            <th width="120px">Code</th>
            <th>Title</th>
            <th>Category</th>
            <th>Quoted Price</th>
            <th>Requested By</th>
          </tr>
          </thead>
          <tbody>
          @foreach($tickets as $ticket)
            <tr>
              <td>{{  TicketStat::$values[$ticket->stat]  }}</td>
              <td>
                <a href="{{ ViewHelper::ticketLink($ticket) }}">{{ $ticket->ticket_code }}</a>
              </td>
              <td>{{  $ticket->title }}</td>
              <td>{{ isset($categories[$ticket->category_id]) ? $categories[$ticket->category_id] : '' }}</td>
              <td>{{ $ticket->quoted_price }}</td>
              <td>{{ $ticket->requested_by }} on {{ ViewHelper::formatDate($ticket->requested_on) }}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection