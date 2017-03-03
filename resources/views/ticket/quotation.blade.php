<form action="" method="post" class="form-horizontal">
  {!! csrf_field() !!}
  <div class="form-body">
    <div class="form-group">
      <label class="control-label col-md-2">Service Cost</label>
      <div class="col-md-10">
        {{Form::text('title', $ticket->quotation->title, ['class'=>'form-control'])}}
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-md-2">Quotation Description</label>
      <div class="col-md-10">
        {{Form::textarea('operator_desc', $ticket->quotation->quotation_desc, ['class'=>'form-control', 'rows'=>5])}}
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-md-2">Preferred Slots</label>
      <div class="col-md-10">
        <table class="table table-hover table-bordered no-margin-btm">
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

    <div class="form-group">
      <label class="control-label col-md-2">Skills</label>
      <div class="col-md-10">
        <div class="mt-checkbox-inline">
          @foreach($skills as $skill)
            <label class="mt-checkbox mt-checkbox-outline">
              <input type="checkbox" value="{{$skill}}" v-model="selected_skills"/> {{ $skill }}
              <span></span>
            </label>
          @endforeach
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-md-2">Staffs</label>
      <div class="col-md-10">
        <select id="staffs" class="form-control select2-multiple" multiple="multiple">
          <option v-for="staff in staffs" v-bind:value="staff.staff_id">@{{ staff.name }}</option>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-md-2">Date</label>
      <div class="col-md-10">

        <button type="button" class="btn btn-default"><i class="fa fa-angle-left"></i> 27 Feb 2017</button>
        <button type="button" class="btn green-meadow">28 Feb 2017</button>
        <button type="button" class="btn btn-default">29 Feb 2017 <i class="fa fa-angle-right"></i></button>

        {{--@{{selected_skills}}<br>
        @{{ calendar_columns }}<br>
        @{{ calendar_intervals }}<br>
        @{{ calendar_rows }}--}}
      </div>
    </div>

    <div class="form-group">
      <label for="" class="control-label col-md-2"></label>
      <div class="col-md-10">
        <table class="table table-hover table-bordered">
          <thead>
          <tr>
            <th></th>
            <th v-for="name in calendar_columns">@{{ name }}</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="interval in calendar_intervals">
            <td width="100px">@{{ interval }}</td>
            <td v-for="v in calendar_rows[interval]">
              @{{ v.text }}
            </td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>

  </div>

</form>