<?php use App\Models\Enums\Role; ?>

@extends("template")

@section("content")
  <div class="row">
    <div class="col-md-6">
      <h1 class="page-title">Roles</h1>
    </div>
    <div class="col-md-6 text-right">
      <button type="button" class="btn blue" onclick="location.href='{{url('ticket/save')}}'">Create</button>
    </div>
  </div>

  <div class="portlet light bordered">
    <div class="portlet-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
          <tr>
            <th width="120px">Name</th>
            <th>Accesses</th>
          </tr>
          </thead>
          <tbody>
          @foreach($roles as $role => $accesses)
            <tr>
              <td><a href="{{url('role/view/'.Role::$values[$role])}}">{{ Role::$values[$role] }}</a></td>
              <td>{{ implode(', ', $accesses) }}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection