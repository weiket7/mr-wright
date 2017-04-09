<?php use App\Models\Enums\StaffStat; ?>

@extends("template")

@section('content')
  <h1 class="page-title">
    {{ucfirst($action)}} Staff
  </h1>

  <div class="portlet light bordered" id="app">
    <div class="portlet-body form">
      <form action="" method="post" class="form-horizontal">
        {!! csrf_field() !!}
        <div class="form-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Name</label>
                <div class="col-md-9">
                  {{Form::text('name', $staff->name, ['class'=>'form-control'])}}
                </div>
              </div>
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