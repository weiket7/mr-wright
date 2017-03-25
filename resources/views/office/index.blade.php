<?php use App\Models\Enums\OfficeStat; ?>

@extends("template")

@section("content")
  <div class="row">
    <div class="col-md-6">
      <h1 class="page-title">Offices</h1>
    </div>
    <div class="col-md-6 text-right">
      <button type="button" class="btn blue" onclick="location.href='{{url('office/save')}}'">Create</button>
    </div>
  </div>

<div class="portlet light bordered">
    <div class="portlet-body">
      <form action="" method="post">
        {!! csrf_field() !!}
        <table class="table table-bordered">
          <thead>
          <tr>
            <th class="search-th-stat">Status</th>
            <th class="search-th-txt">Name</th>
            <th>Company</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td>
              {!! Form::select('stat', OfficeStat::$values, '', ['class'=>'form-control search-stat', 'placeholder'=>'']) !!}
            </td>
            <td>{!! Form::text('name', '', ['class'=>'form-control search-txt', 'id'=>'name']) !!}</td>
            <td>{!! Form::select('company_id', $companies, '', ['class'=>'form-control search-dropdown', 'placeholder'=>'']) !!}</td>
          </tr>
          </tbody>
        </table>

        <div class="row">
          <div class="col-md-12 text-center">
            <button type="submit" name="submit" class="btn blue" value="Search">Search</button>
            <button type="reset" class="btn green">Clear</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="portlet light bordered">
    <div class="portlet-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
          <tr>
            <th width="70px">Status</th>
            <th width="200px">Company</th>
            <th>Name</th>
          </tr>
          </thead>
          <tbody>
          @foreach($offices as $office)
            <tr>
              <td>{{OfficeStat::$values[$office->stat]}}</td>
              <td>{{$office->company_name}}</td>
              <td><a href="{{url("office/save/".$office->office_id)}}">{{ $office->name }}</a></td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection