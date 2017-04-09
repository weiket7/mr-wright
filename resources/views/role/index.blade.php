<?php use App\Models\Enums\Role; ?>

@extends("template")

@section("content")
  <div class="row">
    <div class="col-md-6">
      <h1 class="page-title">Roles</h1>
    </div>
    <div class="col-md-6 text-right">
      <button type="button" class="btn blue" onclick="location.href='{{url('role/save')}}'">Create</button>
    </div>
  </div>

  <div class="portlet light bordered">
    <div class="portlet-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>Name</th>
          </tr>
          </thead>
          <tbody>
          @foreach($roles as $role)
            <tr>
              <td><a href="{{url('role/save/'.$role->role_id)}}">{{ $role->name }}</a></td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection