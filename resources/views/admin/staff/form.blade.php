<?php use App\Models\Enums\StaffStat; ?>

@extends("admin.template")

@section('content')
  <h1 class="page-title">
    {{ucfirst($action)}} Staff
  </h1>
  
  <div class="portlet light bordered" id="app">
    <div class="portlet-body form">
      <div class="tabbable">
        <ul class="nav nav-tabs">
          <li class="active">
            <a href="#tab-general" data-toggle="tab">
              General </a>
          </li>
          <li>
            <a href="#tab-assignments" data-toggle="tab">Assignments</a>
          </li>
        </ul>
        <div class="tab-content no-space">
          <div class="tab-pane fade active in" id="tab-general">
            <form action="" method="post" class="form-horizontal">
              {!! csrf_field() !!}
              <div class="form-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Username</label>
                      <div class="col-md-9">
                        @if($action == 'create')
                          {{Form::text('username', $staff->username, ['class'=>'form-control'])}}
                        @else
                          <div class="form-control-static">
                            {{ $staff->username }}
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Status</label>
                      <div class="col-md-9">
                        {{Form::select('stat', StaffStat::$values, $staff->stat, ['class'=>'form-control', 'placeholder'=>''])}}
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Name</label>
                      <div class="col-md-9">
                        {{Form::text('name', $staff->name, ['class'=>'form-control'])}}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Password</label>
                      <div class="col-md-9">
                        {{Form::password('password', ['class'=>'form-control'])}}
                        <span class="help-block">Fill in password field only when you want to update the password</span>
                      </div>
                    </div>
                  </div>
                </div>
      
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Mobile</label>
                      <div class="col-md-9">
                        {{Form::text('mobile', $staff->mobile, ['class'=>'form-control'])}}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Email</label>
                      <div class="col-md-9">
                        {{Form::text('email', $staff->email, ['class'=>'form-control'])}}
                      </div>
                    </div>
                  </div>
                </div>
      
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Skill</label>
                      <div class="col-md-9">
                        <input type="hidden" name="staff_skills" :value="JSON.stringify(staff_skills)">
              
                        <div class="row">
                          <div class="col-md-5">
                            <ul class="list-group">
                              <li v-for="skill in available_skills" :class="{'bg-grey-steel': skill.selected }" class="list-group-item" @click="selectSkill(skill)">
                              @{{ skill.name }}
                              </li>
                            </ul>
                          </div>
                          <div class="col-md-2 text-center">
                            <button type="button" class="btn btn-icon-only blue" @click="addSkill">
                            <i class="fa fa-arrow-right"></i>
                            </button>
                            <br><br>
                            <button type="button" class="btn btn-icon-only blue" @click="removeSkill">
                            <i class="fa fa-arrow-left"></i>
                            </button>
                          </div>
                          <div class="col-md-5">
                            <ul class="list-group">
                              <li v-for="skill in staff_skills" :class="{'bg-grey-steel': skill.selected }" class="list-group-item" @click="selectSkill(skill)">
                              @{{ skill.name }}
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                  </div>
                </div>
              </div>
    
              <div class="form-actions">
                <div class="row">
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-offset-3 col-md-9">
                        <button type="submit" class="btn green">Submit</button>
                        <button type="button" class="btn default">Cancel</button>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6"> </div>
                </div>
              </div>
            </form>
          </div>
          <div class="tab-pane fade" id="tab-assignments">
            <table class="table table-bordered">
              <thead>
              <tr>
                <th width="120px">Ticket Code</th>
                <th width="120px">Date</th>
                <th width="120px">Time Start</th>
                <th>Time End</th>
              </tr>
              </thead>
              <tbody>
              @foreach($staff_assignments as $ticket_id => $assignment)
                @foreach($assignment as $a)
                <tr>
                  <td><a href="{{url('admin/ticket/view/'.$a->ticket_id)}}">{{ $a->ticket_code }}</a></td>
                  <td>{{ ViewHelper::formatDate($a->date) }}</td>
                  <td>{{ ViewHelper::formatTime($a->time_start) }}</td>
                  <td>{{ ViewHelper::formatTime($a->time_end) }}</td>
                </tr>
                @endforeach
              </tbody>
              @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection


@section('script')
  <script>
    var vm = new Vue({
      el: "#app",
      data: {
        staff_skills: {!! count($staff_skills) ? json_encode($staff_skills) : "{}" !!},
        available_skills: {!! count($available_skills) ? json_encode($available_skills) : "{}" !!}
      },
      methods: {
        selectSkill: function(skill) {
          if (typeof skill.selected  == "undefined") {
            Vue.set(skill, 'selected', true);
          } else {
            skill.selected  = ! skill.selected;
          }
          //console.log(skill.selected );
        },
        addSkill: function() {
          var obj = this.available_skills;
          
          for (var key in obj) {
            if (obj.hasOwnProperty(key)) {
              if (obj[key].selected === true) {
                Vue.set(this.staff_skills, key, obj[key]);
                Vue.delete(obj, key);
              }
            }
          }
        },
        removeSkill: function() {
          var obj = this.staff_skills;
          
          for (var key in obj) {
            if (obj.hasOwnProperty(key)) {
              if (obj[key].selected === true) {
                Vue.set(this.available_skills, key, obj[key]);
                Vue.delete(obj, key);
              }
            }
          }
        }
      }
    });
  </script>
@endsection