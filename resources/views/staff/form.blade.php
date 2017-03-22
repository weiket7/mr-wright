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
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Skill</label>
                <div class="col-md-9">
                  <input type="hidden" name="staff_skills_count" v-bind:value="staff_skills.length">
  
                  <table class="table table-bordered no-margin-btm">
                    <tbody>
                    <tr v-for="(skill, index) in staff_skills" v-bind:class="'row-'+skill.stat">
                      <td width="57px">
                        <button type="button" class="btn btn-icon-only blue" @click="deleteStaffSkill(index)">
                        <i v-if="skill.name" class="fa fa-undo"></i>
                        <i v-else="" class="fa fa-times"></i>
                        </button>
                        <input type="hidden" v-bind:name="'staff_skill_stat'+index" v-bind:value="skill.stat" v-if="skill.stat">
                        <input type="hidden" v-bind:name="'staff_skill_id'+index" v-bind:value="skill.staff_skill_id">
                      </td>
                      <td>
                        <select :name="'staff_skill'+index" v-model="skill.skill_id" class="form-control">
                          <option></option>
                          <option v-for="(name, skill_id) in skills" :value="skill_id">
                            @{{ name }}
                          </option>
                        </select>
                      </td>
                    </tr>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="2">
                          <div class="text-center">
                            <button type="button" @click="addStaffSkill" class="btn blue">
                              Add
                            </button>
                          </div>
                        </td>
                      </tr>
                    </tfoot>
                  </table>
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
        staff_skills: {!! $staff_skills !!},
        skills: {!! $skills !!}
      },
      methods: {
        addStaffSkill: function() {
          this.staff_skills.push({name:'', stat:'add'});
        },
        deleteStaffSkill: function(index) {
          var skill = this.staff_skills[index];
          if (skill.stat === 'add') {
            this.staff_skills.splice(index, 1);
          }
      
          if (skill.stat == 'delete') {
            skill.stat = '';
          } else {
            Vue.set(skill, 'stat', 'delete');
          }
        }
      }
    });
  </script>
@endsection