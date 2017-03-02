<form action="" method="post" class="form-horizontal">
  {!! csrf_field() !!}
  <div class="form-body">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label class="control-label col-md-2">Service Cost</label>
          <div class="col-md-10">
            {{Form::text('title', $ticket->quotation->title, ['class'=>'form-control'])}}
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label class="control-label col-md-2">Quotation Description</label>
          <div class="col-md-10">
            {{Form::textarea('operator_desc', $ticket->quotation->quotation_desc, ['class'=>'form-control', 'rows'=>5])}}
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label class="control-label col-md-2">Preferred Slots</label>
          <div class="col-md-10">
            <table class="table table-hover table-bordered">
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
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label class="control-label col-md-2">Available Staff</label>
          <div class="col-md-10">
            <button type="button" class="btn btn-default"><i class="fa fa-angle-left"></i> 27 Feb 2017</button>
            <button type="button" class="btn green-meadow">28 Feb 2017</button>
            <button type="button" class="btn btn-default">29 Feb 2017 <i class="fa fa-angle-right"></i></button>
            <br><br>
            <div class="mt-checkbox-list">
              @foreach($skills as $skill)
              <label class="mt-checkbox mt-checkbox-outline">
                {{ $skill }}
                <input type="checkbox" value="{{$skill}}" v-model="selected_skills"/>
                <span></span>
              </label>
              @endforeach
            </div>

            {{--@{{selected_skills}}<br>
            @{{ calendar_columns }}<br>
            @{{ calendar_intervals }}<br>
            @{{ calendar_rows }}--}}

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
    </div>
  </div>

  <div class="form-actions">
    <div class="row">
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-offset-3 col-md-9">
            <button type="submit" class="btn green">
              {{ ucfirst($action) }}
            </button>
            <button type="button" class="btn blue" onclick="location.href='{{url('quotation/save/1')}}'">
              Create Quotation
            </button>
            {{--<button type="button" class="btn default">Cancel</button>--}}
          </div>
        </div>
      </div>
      <div class="col-md-6"> </div>
    </div>
  </div>
</form>