<?php use App\Models\Helpers\BackendHelper; ?>

@extends('admin.template')

@section("content")
  <h1 class="page-title">
    System
  </h1>

  <div class="portlet light bordered">
    <div class="portlet-body">

      <table class="table table-bordered">
        <thead>
        <tr>
          <th width="150px">Name</th>
          <th>Value</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>Application</td>
          <td>{{ config('app.name') }}</td>
        </tr>
        <tr>
          <td>Mail</td>
          <td>
            Driver: {{ env('MAIL_DRIVER') }}<br>
            Host: {{ env('MAIL_HOST') }}<br>
            Port: {{ env('MAIL_PORT') }}<br>
            Username: {{ env('MAIL_USERNAME') }}
          </td>
        </tr>
        <tr>
          <td>Laravel</td>
          <td>
            <?php $app = App::getFacadeApplication(); ?>
            {{$app::VERSION}}
          </td>
        </tr>
        <tr>
          <td>PHP</td>
          <td>
            {{phpversion()}}<br>
            <?php echo "GD: ", extension_loaded('gd') ? 'OK' : 'MISSING', '<br>';
            echo "XML: ", extension_loaded('xml') ? 'OK' : 'MISSING', '<br>';
            echo "zip: ", extension_loaded('zip') ? 'OK' : 'MISSING', '<br>'; ?>
          </td>
        </tr>
        <tr>
          <td>Env</td>
          <td>{{App::environment()}}</td>
        </tr>
        <tr>
          <td>Timezone</td>
          <td>{{date_default_timezone_get()}}</td>
        </tr>
        <tr>
          <td>Upload Directory</td>
          <td>{{BackendHelper::getDir('')}}</td>
        </tr>
        <tr>
          <td>Accesses</td>
          <td>
            {{ var_dump(Session::get('accesses')) }}
          </td>
        </tr>
      </table>
    </div>
  </div>
@endsection