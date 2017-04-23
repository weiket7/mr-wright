@extends('frontend.template', ['title'=>strtoupper($action). ' TICKET'])

@section('content')
  <form method="post" action="" class="form-horizontal" id="app">
    {{ csrf_field() }}

    <div class="form-group">
      <label class="control-label col-md-2">
        Title
      </label>
      <div class="col-md-10">
        {{Form::text('title', $ticket->title, ['class'=>'form-control', 'autofocus'])}}
      </div>
    </div>

    @if($ticket->stat != null)
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Ticket Code
            </label>
            <label class="col-md-9 form-control-static">
              {{ $ticket->ticket_code }}
            </label>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label col-md-3">
              Status
            </label>
            <label class="col-md-9 form-control-static">
              {{ \App\Models\Enums\TicketStat::$values[$ticket->stat] }}
            </label>
          </div>
        </div>
      </div>
    @endif

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Category
          </label>
          <div class="col-md-9">
            {{ Form::select('category_id', $categories, $ticket->category_id, ['placeholder'=>'', 'class'=>'form-control']) }}
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Urgency
          </label>
          <div class="col-md-9">
            {{Form::select('urgency', \App\Models\Enums\TicketUrgency::$values, $ticket->urgency, ['placeholder'=>'', 'class'=>'form-control'])}}
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Company Name
          </label>
          <label class="col-md-9 form-control-static">
            @if($ticket->stat == null)
              {{ $requester->company_name }}
            @else
              {{ $ticket->company_name }}
            @endif
          </label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Office Name
          </label>
          <div class="col-md-9">

            <label class="form-control-static">
              {{ $requester->office_name }}
            </label>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Address
          </label>
          <label class="col-md-9 form-control-static" id="office_addr">
            @if($ticket->stat == null)
              {{ $requester->office_addr }}
            @else
              {{ $ticket->office_addr }}
            @endif
          </label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Postal Code
          </label>
          <label class="col-md-9 form-control-static" id="office_postal">
            @if($ticket->stat == null)
              {{ $requester->office_postal }}
            @else
              {{ $ticket->office_postal }}
            @endif
          </label>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Requested By
          </label>
          <label class="col-md-9 form-control-static">
            Jessie on {{ ViewHelper::formatDateTime(\Carbon\Carbon::now()) }}
          </label>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="control-label col-md-3">
            Description
          </label>
          <div class="col-md-9">
            {{Form::textarea('requester_desc', $ticket->requester_desc, ['rows'=>3, 'class'=>'form-control'])}}
          </div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-md-2">
        Issues
      </label>
      <div class="col-md-10">
        <input type="hidden" name="issues_count" v-bind:value="issues.length">

        <table class="table table-bordered">
          <thead>
          <tr>
            <th width="60px"></th>
            <th>Image / Video</th>
            <th>Issue</th>
            <th>Expected</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="(issue, index) in issues" v-bind:class="'row-'+issue.stat">
            <td>
              <button type="button" class="btn btn-primary" @click="deleteIssue(index)">
              <i v-if="issue.stat" class="fa fa-undo"></i>
              <i v-else="" class="fa fa-times"></i>
              </button>
              <input type="hidden" v-bind:name="'issue_stat'+index" v-bind:value="issue.stat" v-if="issue.stat">
              <input type="hidden" v-bind:name="'issue_id'+index" v-bind:value="issue.ticket_issue_id">
            </td>
            <td>
              <div v-bind:id="'preview-image' + index">
                <img v-if="isImage(issue.image)" :src="'{{asset('images/tickets')}}/'+ issue.image" v-if="issue.image" class="ticket-image"/>
                <video v-else-if="isVideo(issue.image)" width="320" height="240" controls>
                  <source :src="'{{asset('images/tickets')}}/'+ issue.image">
                  Your browser does not support the video tag.
                </video>
              </div>
              <input type="file" v-bind:name="'image' + index" v-on:change="previewImage(index,$event)">
            </td>
            <td>
              <textarea v-bind:name="'issue' + index" class="form-control" placeholder="Issue">@{{ issue.issue_desc }}</textarea>
            </td>
            <td>
              <textarea v-bind:name="'expected' + index"  class="form-control" placeholder="Expected">@{{ issue.expected_desc }}</textarea>
            </td>
          </tr>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="4" class="text-center">
                <div class="text-center">
                  <button type="button" @click="addIssue" class="btn btn-primary">Add</button>
                </div>
              </td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-md-2">
        Preferred Slots
      </label>
      <div class="col-md-10">
        <input type="hidden" name="preferred_slots_count" v-bind:value="preferred_slots.length">

        <table class="table table-bordered">
          <thead>
          <tr>
            <th width="60px"></th>
            <th>Date</th>
            <th>Time</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="(slot, index) in preferred_slots" v-bind:class="'row-'+slot.stat">
            <td>
              <button type="button" class="btn btn-primary" @click="deletePreferredSlot(index)">
                <i v-if="slot.stat" class="fa fa-undo"></i>
                <i v-else="" class="fa fa-times"></i>
              </button>
              <input type="hidden" v-bind:name="'preferred_slot_stat'+index" v-bind:value="slot.stat" v-if="slot.stat">
              <input type="hidden" v-bind:name="'preferred_slot_id'+index" v-bind:value="slot.ticket_preferred_slot_id">
            </td>
            <td>
              <input type="text" v-bind:name="'preferred_slot_date'+index" v-bind:value="slot.date | formatDate" class="form-control datepicker">
            </td>
            <td>
              <dropdown-time :name="'preferred_slot_time_start'+index" :value="slot.time_start"></dropdown-time>
              <dropdown-time :name="'preferred_slot_time_end'+index" :value="slot.time_end"></dropdown-time>
            </td>
          </tr>
          </tbody>
          <tfoot>
          <tr>
            <td colspan="4">
              <div class="text-center">
                <button type="button" @click="addPreferredSlot" class="btn btn-primary">Add</button>
              </div>
            </td>
          </tr>
          </tfoot>
        </table>
      </div>
    </div>

    <div class="text-center">
      @if($ticket->stat == null)
        <input type="submit" name="submit" value="DRAFT TICKET" class="more active">
      @elseif($ticket->stat == \App\Models\Enums\TicketStat::Drafted)
        <input type="submit" name="submit" value="UPDATE TICKET" class="more active">
        <input type="submit" name="submit" value="OPEN TICKET" class="more active">
      @elseif($ticket->stat == \App\Models\Enums\TicketStat::Opened)
        <input type="submit" name="submit" value="UPDATE TICKET" class="more active">
        <input type="submit" name="submit" value="OPEN TICKET" class="more active">
      @endif
    </div>


  </form>
@endsection

@section('script')
  <script src="{{asset('assets/js/axios.min.js')}}" type="text/javascript"></script>


  <script>
    $(document).ready(function() {

      $("#office_id").change(function() {
        var office_id = $(this).val();

        axios.get('{{url('api/getOffice')}}?office_id='+office_id)
        .then(function (response) {
          var office = response.data;
          $("#office_addr").text(office.addr);
          $("#office_postal").text(office.postal);
        })
        .catch(function (error) {
          console.log('office_id change error='+error);
        })
      });
    });

    Vue.component('dropdown-time', {
      props: ['name', 'value'],
      data() {
        return {
          times: [
            {key:'', value:''},
            {key: '00:00', value: '12:00 am'},
            {key: '01:00', value: '1:00 am'},
            {key: '02:00', value: '2:00 am'},
            {key: '03:00', value: '3:00 am'},
            {key: '04:00', value: '4:00 am'},
            {key: '05:00', value: '5:00 am'},
            {key: '06:00', value: '6:00 am'},
            {key: '07:00', value: '7:00 am'},
            {key: '08:00', value: '8:00 am'},
            {key: '09:00', value: '9:00 am'},
            {key: '10:00', value: '10:00 am'},
            {key: '11:00', value: '11:00 am'},
            {key: '12:00', value: '12:00 pm'},
            {key: '13:00', value: '1:00 pm'},
            {key: '14:00', value: '2:00 pm'},
            {key: '15:00', value: '3:00 pm'},
            {key: '16:00', value: '4:00 pm'},
            {key: '17:00', value: '5:00 pm'},
            {key: '18:00', value: '6:00 pm'},
            {key: '19:00', value: '7:00 pm'},
            {key: '20:00', value: '8:00 pm'},
            {key: '21:00', value: '9:00 pm'},
            {key: '22:00', value: '10:00 pm'},
            {key: '23:00', value: '11:00 pm'}
          ]
        }
      },
      created(){
        this.selectedOption = this.value;
      },
      template: "<select :name='name' v-model='selectedOption' class='form-control'><option v-for='time in times' :value='time.key'>@{{ time.value }}</option></select>"
    });

    var vm = new Vue({
      el: "#app",
      data: {
        issues: {!! $ticket->issues !!},
        preferred_slots: {!! $ticket->preferred_slots !!},
        currentDate: moment()
      },
      methods: {
        addPreferredSlot: function() {
          var slot = {date: this.currentDate.format('YYYY-MM-DD'), time_start: '', time_end: '', stat:'add'};
          this.preferred_slots.push(slot);
        },
        deletePreferredSlot: function(index) {
          var slot = this.preferred_slots[index];
          if (slot.stat === 'add') {
            this.preferred_slots.splice(index, 1);
          }

          if (slot.stat == 'delete') {
            slot.stat = '';
          } else {
            Vue.set(slot, 'stat', 'delete');
            this.preferred_slots_delete.push(slot.ticket_issue_id);
          }
        },
        addIssue: function() {
          this.issues.push({image:'', issue_desc:'', expected_desc:'', stat:'add'});
        },
        deleteIssue: function(index) {
          var issue = this.issues[index];
          if (issue.stat === 'add') {
            this.issues.splice(index, 1);
          }

          if (issue.stat == 'delete') {
            issue.stat = '';
          } else {
            Vue.set(issue, 'stat', 'delete');
          }
        },
        previewImage: function(index,e) {
          var reader = new FileReader();
          var file_mime = e.target.files[0].type;
          if (fileMimeIsImage(file_mime) === false) {
            $('#preview-image' + index).html("Video");
            return;
          }
          reader.onload = function (e) {
            var img = $('<img/>', {
              width:250,
              height:200,
              src: e.target.result
            });
            $('#preview-image'+index).html(img);
          };
          var file = e.target.files[0];
          reader.readAsDataURL(file);
        },
        isImage: function(file_name) {
          return fileExtensionIsImage(file_name);
        },
        isVideo: function(file_name) {
          return fileExtensionIsVideo(file_name);
        }
      },
      filters: {
        formatDate: function (value) {
          if (value instanceof moment === false) {
            value = moment(value, "YYYY-MM-DD");
          }
          return value.format('DD MMM YYYY');
        },
        formatTime: function(value) {
          if (typeof value === "undefined" || value === "") {
            return '';
          }
          if (value instanceof moment === false) {
            value = moment(value, "HH:mm:ss");
          }
          return value.format('h:mma');
        }
      }
    });
  </script>
@endsection