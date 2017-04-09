<?php use App\Models\Enums\ProductStat; ?>

@extends("template")

@section('content')
  <h1 class="page-title">
    {{ucfirst($action)}} Role
  </h1>

  <div class="portlet light bordered" id="app">
    <div class="portlet-body form">
      <form action="" method="post" class="form-horizontal">
        {!! csrf_field() !!}
        <div class="form-body">
          <div class="form-group">
            <label class="control-label col-md-2">Name</label>
            <div class="col-md-10">
              @if($action == 'update')
                <div class="form-control-static">{{ $role->name }}</div>
              @else
                {{Form::text('name', $role->name, ['class'=>'form-control', 'maxlength'=>30])}}
              @endif
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2">Accesses</label>
            <div class="col-md-10">
              <input type="hidden" name="role_accesses" :value="JSON.stringify(role_accesses)">

              <div class="row">
                <div class="col-md-5">
                  <ul class="list-group">
                    <li v-for="access in available_accesses" :class="{'bg-grey-steel': access.selected }" class="list-group-item" @click="selectAccess(access)">
                      @{{ access.name }}
                    </li>
                  </ul>
                </div>
                <div class="col-md-2 text-center">
                  <button type="button" class="btn btn-icon-only blue" @click="addAccess">
                    <i class="fa fa-arrow-right"></i>
                  </button>
                  <br><br>
                  <button type="button" class="btn btn-icon-only blue" @click="removeAccess">
                    <i class="fa fa-arrow-left"></i>
                  </button>
                </div>
                <div class="col-md-5">
                  <ul class="list-group">
                    <li v-for="access in role_accesses" :class="{'bg-grey-steel': access.selected }" class="list-group-item" @click="selectAccess(access)">
                      @{{ access.name }}
                    </li>
                  </ul>
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
        role_accesses: {!! count($role_accesses) ? json_encode($role_accesses) : "{}" !!},
        available_accesses: {!! count($available_accesses) ? json_encode($available_accesses) : "{}" !!}
      },
      methods: {
        selectAccess: function(access) {
          if (typeof access.selected  == "undefined") {
            Vue.set(access, 'selected', true);
          } else {
            access.selected  = ! access.selected;
          }
          //console.log(access.selected );
        },
        addAccess: function() {
          var obj = this.available_accesses;

          for (var key in obj) {
            if (obj.hasOwnProperty(key)) {
              if (obj[key].selected === true) {
                Vue.set(this.role_accesses, key, obj[key]);
                Vue.delete(obj, key);
              }
            }
          }
        },
        removeAccess: function() {
          var obj = this.role_accesses;

          for (var key in obj) {
            if (obj.hasOwnProperty(key)) {
              if (obj[key].selected === true) {
                Vue.set(this.available_accesses, key, obj[key]);
                Vue.delete(obj, key);
              }
            }
          }
        }
      }
    });
  </script>
@endsection