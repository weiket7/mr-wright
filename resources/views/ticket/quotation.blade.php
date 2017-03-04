<form action="" method="post" class="form-horizontal">
  {!! csrf_field() !!}
  <div class="form-group">
    <label class="control-label col-md-2">Service Cost</label>
    <div class="col-md-10">
      {{Form::text('title', $ticket->quotation->title, ['class'=>'form-control'])}}
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
            <input type="checkbox" value="{{$skill}}" name="skills"/> {{ $skill }}
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
      </select>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-2">Date</label>
    <div class="col-md-10">

      <div class="input-group" style="max-width:300px">
        <span class="input-group-btn">
            <button class="btn red" type="button" @click="previousDate">Previous</button>
        </span>
        <input type="text" id="date" name="date" v-model="currentDateFormatted" class="form-control datepicker datepicker-width">
        <span class="input-group-btn">
            <button class="btn red" type="button" @click="nextDate">Next</button>
        </span>
      </div>
    </div>
  </div>

  <div class="form-group">
    <label for="" class="control-label col-md-2" id="assignments">Calendar</label>
    <div class="col-md-10">
      <div id="calendar"></div>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-2">Quotation Description</label>
    <div class="col-md-10">
      {{Form::textarea('operator_desc', $ticket->quotation->quotation_desc, ['class'=>'form-control', 'rows'=>5])}}
    </div>
  </div>


</form>