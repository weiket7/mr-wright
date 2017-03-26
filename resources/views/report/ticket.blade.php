<?php use App\Models\Enums\TicketStat; ?>
<?php use App\Models\Enums\TicketUrgency; ?>

@extends("template")

@section("content")
  <div class="row">
    <div class="col-md-12">
      <h1 class="page-title">Report - Tickets</h1>
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
            <th class="search-th-stat">Category</th>
            <th class="search-th-stat">Urgency</th>
            <th>Company</th>
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
                <input type="text" class="form-control" name="from" placeholder="From">
                <span class="input-group-addon"> to </span>
                <input type="text" class="form-control" name="to" placeholder="To">
              </div>
            </td>
            <td>
              <select class="form-control search-dropdown" style="margin-bottom: 10px">
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
                <input type="text" class="form-control" name="from" placeholder="From">
                <span class="input-group-addon"> to </span>
                <input type="text" class="form-control" name="to" placeholder="To">
              </div>
            </td>
            <td>
              <div class="mt-checkbox-list">
                @foreach($categories as $s)
                  <label class="mt-checkbox mt-checkbox-outline"> {{ $s }}
                    <input type="checkbox" value="{{$s}}" name="stat">
                    <span></span>
                  </label>
                @endforeach
              </div>
            </td>
            <td>
              <div class="mt-checkbox-list">
                @foreach(TicketUrgency::$values as $s)
                  <label class="mt-checkbox mt-checkbox-outline"> {{ $s }}
                    <input type="checkbox" value="{{$s}}" name="stat">
                    <span></span>
                  </label>
                @endforeach
              </div>
            </td>
            <td>
              {{Form::select('company_id', $companies, '', ['id'=>'company_id', 'class'=>'form-control', 'placeholder'=>''])}}
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

@endsection