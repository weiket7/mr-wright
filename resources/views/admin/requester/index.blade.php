<?php use App\Models\Enums\RequesterStat; ?>
<?php use App\Models\Enums\RequesterType; ?>

@extends("admin.template")

@section("content")
  <div class="row">
    <div class="col-xs-6">
      <h1 class="page-title">Requesters</h1>
    </div>
    <div class="col-xs-6 text-right">
      <button type="button" class="btn blue" onclick="location.href='{{url('admin/requester/save')}}'">Create</button>
    </div>
  </div>

  <div class="portlet light bordered">
    <div class="portlet-body">
      <form action="" method="post">
        {!! csrf_field() !!}
          <div class="table-responsive">
            <table class="table table-bordered">
            <thead>
            <tr>
              <th class="search-th-stat">Status</th>
              <th class="search-th-txt">Name</th>
              <th class="search-th-dropdown">Company</th>
              <th class="search-th-dropdown">Office</th>
              <th>Show top</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>
                {!! Form::select('stat', RequesterStat::$values, '', ['class'=>'form-control search-stat', 'placeholder'=>'']) !!}
              </td>
              <td>{!! Form::text('name', '', ['class'=>'form-control', 'id'=>'name']) !!}</td>
              <td>{!! Form::select('company_id', $companies, '', ['id'=>'company_id', 'class'=>'form-control search-dropdown', 'placeholder'=>'']) !!}</td>
              <td>{!! Form::select('office_id', [], '', ['id'=>'office_id', 'class'=>'form-control search-dropdown', 'placeholder'=>'']) !!}</td>
              <td>{!! Form::text('limit', 100, ['class'=>'form-control search-txt']) !!}</td>
            </tr>
            </tbody>
          </table>
        </div>

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
            <th width="70px">Type</th>
            <th width="200px">Name</th>
            <th width="200px">Company</th>
            <th>Office</th>
          </tr>
          </thead>
          <tbody>
          @foreach($requesters as $requester)
            <tr>
              <td>{{RequesterStat::$values[$requester->stat]}}</td>
              <td>{{RequesterType::$values[$requester->type]}}</td>
              <td><a href="{{url("admin/requester/save/".$requester->requester_id)}}">{{ $requester->name }}</a></td>
              <td>{{$requester->company_name}}</td>
              <td>{{$requester->office_name}}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection