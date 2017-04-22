@extends("admin.template")

@section("content")
  <div class="row">
    <div class="col-md-6">
      <h1 class="page-title">Memberships</h1>
    </div>
    <div class="col-md-6 text-right">
      <button type="button" class="btn blue" onclick="location.href='{{url('admin/membership/save')}}'">Create</button>
    </div>
  </div>
  
  <div class="portlet light bordered">
    <div class="portlet-body">
      <form action="" method="post">
        {!! csrf_field() !!}
        <table class="table table-bordered">
          <thead>
          <tr>
            <th>Status</th>
            <th>Name</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td>
              {!! Form::select('stat', \App\Models\Enums\MembershipStat::$values, '', ['class'=>'form-control', 'id'=>'stat', 'placeholder'=>'']) !!}
            </td>
            <td>{!! Form::text('name', '', ['class'=>'form-control', 'id'=>'name']) !!}</td>
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
            <th>Name</th>
          </tr>
          </thead>
          <tbody>
          @foreach($memberships as $membership)
            <tr>
              <td>{{\App\Models\Enums\MembershipStat::$values[$membership->stat]}}</td>
              <td><a href="{{url("admin/membership/save/".$membership->membership_id)}}">{{ $membership->name }}</a></td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection