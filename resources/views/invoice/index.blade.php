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
      <form action="" method="post" class="">
        {!! csrf_field() !!}
        <table class="table table-bordered">
          <thead>
          <tr>
            <th class="search-th-stat">Status</th>
            <th class="search-th-fromto">Quoted Price</th>
            <th class="search-th-fromto">Date</th>
            <th>Company</th>
            <th>Office</th>
            <th>Requested By</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td>
              <?php $stats = TicketStat::$values;
              unset($stats[TicketStat::Drafted]); ?>
              <div class="mt-checkbox-list">
                @foreach($stats as $s)
                  <label class="mt-checkbox mt-checkbox-outline"> {{ $s }}
                    <input type="checkbox" value="{{$s}}" name="stat">
                    <span></span>
                  </label>
                @endforeach
              </div>
            </td>
            <td>
              <div class="input-group input-large input-daterange">
                <input type="text" class="form-control" name="quoted_price_from" placeholder="From">
                <span class="input-group-addon"> to </span>
                <input type="text" class="form-control" name="quoted_price_to" placeholder="To">
              </div>
            </td>
            <td>
              <select name="date_column" class="form-control search-dropdown" style="margin-bottom: 10px">
                <option value=""></option>
                <option value="">Requested On</option>
                <option value="">Opened On</option>
                <option value="">Quoted On</option>
                <option value="">Accepted On</option>
                <option value="">Declined On</option>
                <option value="">Completed On</option>
                <option value="">Invoiced On</option>
                <option value="">Paid On</option>
                <option value="">Voided On</option>
              </select>
              <div class="input-group input-large datepicker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
                <input type="text" class="form-control" name="date_from" placeholder="From">
                <span class="input-group-addon"> to </span>
                <input type="text" class="form-control" name="date_to" placeholder="To">
              </div>
            </td>
            <td>
              {{Form::select('company_id', $companies, '', ['id'=>'company_id', 'class'=>'form-control', 'placeholder'=>''])}}
            </td>
            <td>
              {{Form::select('office_id', [], '', ['id'=>'office_id', 'class'=>'form-control', 'placeholder'=>''])}}
            </td>
            <td>
              {{Form::select('requested_by', [], '', ['id'=>'requested_by', 'class'=>'form-control', 'placeholder'=>''])}}
            </td>
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
              <td>{{  $ticket->ticket_code }}</td>
              <td><a href="{{url("ticket/view/".$ticket->ticket_id)}}">{{ $ticket->title }}</a></td>
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