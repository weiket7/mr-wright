<?php use App\Models\Enums\CompanyStat; ?>
<?php use App\Models\Enums\MembershipType; ?>

@extends("admin.template")

@section('content')
  <h1 class="page-title">
    {{ucfirst($action)}} Company
  </h1>
  
  <div class="portlet light bordered">
    <div class="portlet-body form">
      <form action="" method="post" class="form-horizontal">
        {!! csrf_field() !!}
        <input type="hidden" name="delete" id="delete">
        <div class="form-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Name <span class="required">*</span></label>
                <div class="col-md-9">
                  {{Form::text('name', $company->name, ['class'=>'form-control', 'maxlength'=>50])}}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Code @if($action=='create')<span class="required">*</span>@endif</label>
                <div class="col-md-9">
                  {{Form::text('code', $company->code, ['class'=>'form-control', 'maxlength'=>5])}}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">UEN @if($action=='create')<span class="required">*</span>@endif</label>
                <div class="col-md-9">
                  @if($action == 'update')
                    <div class="form-control-static">{{ $company->uen }}</div>
                  @else
                    {{Form::text('uen', $company->uen, ['class'=>'form-control', 'maxlength'=>5])}}
                  @endif
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Registered Name <span class="required">*</span></label>
                <div class="col-md-9">
                  {{Form::text('registered_name', $company->registered_name, ['class'=>'form-control', 'maxlength'=>100])}}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Status <span class="required">*</span></label>
                <div class="col-md-9">
                  {{Form::select('stat', CompanyStat::$values, $company->stat, ['class'=>'form-control'])}}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Address <span class="required">*</span></label>
                <div class="col-md-9">
                  {{Form::textarea('addr', $company->addr, ['class'=>'form-control', 'rows'=>3, 'maxlength'=>200])}}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Postal <span class="required">*</span></label>
                <div class="col-md-9">
                  {{Form::text('postal', $company->postal, ['class'=>'form-control', 'maxlength'=>20])}}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Country</label>
                <div class="col-md-9">
                  {{Form::text('country', $company->country, ['class'=>'form-control', 'maxlength'=>50])}}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Industry</label>
                <div class="col-md-9">
                  {{Form::text('industry', $company->industry, ['class'=>'form-control'])}}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Membership Plan <span class="required">*</span></label>
                <label class="col-md-9 form-control-static">
                  {{ Form::select('membership_id', $memberships, $company->membership_id, ['placeholder'=>'', 'class'=>'form-control']) }}
                </label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Number of Requesters</label>
                <label class="col-md-9 form-control-static">
                  {{ $company->requester_count }} / {{ $company->requester_limit }}
                </label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              @if($company->membership_type != MembershipType::Unlimited)
              <div class="form-group">
                <label class="control-label col-md-3">Valid Till</label>
                <div class="col-md-9">
                  {{Form::text('membership_valid_till', ViewHelper::formatDate($company->membership_valid_till), ['class'=>'form-control datepicker', 'placeholder'=>''])}}
                </div>
              </div>
              @endif
            </div>
          </div>
          @if($action == 'update')
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label col-md-3">Offices</label>
                  <div class="col-md-9">
                    <table class="table table-bordered no-margin-btm">
                      @foreach($offices as $o)
                        <tr>
                          <td><a href="{{url('admin/office/save/'.$o->office_id)}}">{{ $o->name }}</a></td>
                        </tr>
                      @endforeach
                    </table>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
              </div>
            </div>
          @endif
        </div>
        
        <div class="form-actions">
          <div class="row">
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-offset-3 col-md-9">
                  <button type="submit" class="btn green">Submit</button>
                  <button type="submit" class="btn red confirmation" data-toggle='confirmation' data-title="All offices and requesters under this company will be deleted also. Are you sure?">Delete</button>
                  <button type="button" onclick="location.href='{{url('admin/company')}}'" class="btn default">Back to List</button>
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