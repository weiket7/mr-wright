<?php use App\Models\Enums\TicketStat; ?>

@extends("admin.template")

@section("content")
  <div class="row">
    <div class="col-md-6">
      <h1 class="page-title">
        Quotations
      </h1>
    </div>
  </div>

  <div class="portlet light bordered">
    <div class="portlet-body">
      <form action="" method="post">
        <table class="table table-bordered">
          <thead>
          <tr>
            <th>Status</th>
            <th>Name</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td>
              {!! Form::select('stat', TicketStat::$values, '', ['class'=>'form-control', 'id'=>'stat', 'placeholder'=>'']) !!}
            </td>
            <td>{!! Form::text('name', '', ['class'=>'form-control', 'id'=>'name']) !!}</td>
          </tr>
          </tbody>
        </table>

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
            <th width="70px">Status</th>
            <th>Name</th>
          </tr>
          </thead>
          <tbody>
          @foreach($tickets as $ticket)
            <tr>
              <td>{{TicketStat::$values[$ticket->stat]}}</td>
              <td><a href="{{url("ticket/save/".$ticket->ticket_id)}}">{{ $ticket->title }}</a></td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection