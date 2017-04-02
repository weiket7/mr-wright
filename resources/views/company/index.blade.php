<?php use App\Models\Enums\CompanyStat; ?>

@extends("template")

@section("content")
  <div class="row">
    <div class="col-md-6">
      <h1 class="page-title">Companies</h1>
    </div>
    <div class="col-md-6 text-right">
      <button type="button" class="btn blue" onclick="location.href='{{url('company/save')}}'">Create</button>
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
            <th class="search-th-txt">Code</th>
            <th>Name</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td>
              {!! Form::select('stat', CompanyStat::$values, '', ['class'=>'form-control search-stat', 'placeholder'=>'']) !!}
            </td>
            <th>{!! Form::text('code', '', ['class'=>'form-control search-txt']) !!}</th>
            <td>{!! Form::text('name', '', ['class'=>'form-control search-txt']) !!}</td>
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
            <th width="70px">Code</th>
            <th>Name</th>
          </tr>
          </thead>
          <tbody>
          @foreach($companies as $company)
            <tr>
              <td>{{CompanyStat::$values[$company->stat]}}</td>
              <td>{{$company->code}}</td>
              <td><a href="{{url("company/save/".$company->company_id)}}">{{ $company->name }}</a></td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script type="text/javascript">
    function clearSearchCompany() {
      $("#stat").val('');
      $("input[name='name']").val('');
      $("#brand_id").val('');
      $("#category_id").val('');
    }
  </script>
@endsection
