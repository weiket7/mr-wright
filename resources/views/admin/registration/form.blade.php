
@extends("admin.template")

@section('content')
  <h1 class="page-title">
    Approve Registration
  </h1>

  <div class="portlet light bordered">
    <div class="portlet-body form">
      <form action="" method="post" class="form-horizontal">
        {!! csrf_field() !!}
        <div class="form-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Username</label>
                <label class="col-md-9 form-control-static">
                  {{ $registration->username }}
                </label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Status</label>
                <label class="col-md-9 form-control-static">
                  @if($registration->approved)
                    <span class="label label-primary"> Approved </span>
                  @else
                    <span class="label label-warning"> Pending </span>
                  @endif
                </label>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Full Name</label>
                <label class="col-md-9 form-control-static">
                  {{ $registration->name }}
                </label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Designation</label>
                <label class="col-md-9 form-control-static">
                  {{ $registration->designation }}
                </label>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Mobile</label>
                <label class="col-md-9 form-control-static">
                  {{ $registration->mobile }}
                </label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Email</label>
                <label class="col-md-9 form-control-static">
                  {{ $registration->email }}
                </label>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">UEN</label>
                <label class="col-md-9 form-control-static">
                  {{ $registration->uen }}
                </label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Company Name</label>
                <label class="col-md-9 form-control-static">
                  @if($registration->approved == false)
                    {{ $registration->company_name }}
                  @else
                    <a href="{{url('admin/company/save/'.$company->company_id)}}">{{ $company->name }}</a>
                  @endif
                </label>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Address</label>
                <label class="col-md-9 form-control-static">
                  {{ $registration->addr }}
                </label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Postal</label>
                <label class="col-md-9 form-control-static">
                  {{ $registration->postal }}
                </label>
              </div>
            </div>
          </div>

          @if($registration->existing_uen == true)
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label col-md-3">Existing UEN</label>
                  <label class="col-md-9 form-control-static">
                    Yes
                  </label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label col-md-3">Office</label>
                    @if($registration->approved == false)
                      <div class="col-md-9">
                        {{Form::select('office_id', $offices, '', ['placeholder'=>'', 'class'=>'form-control'])}}
                      </div>
                    @else
                      <label class="col-md-9 form-control-static">
                        <a href="{{url('admin/office/save/'.$office->office_id)}}">{{ $office->name }}</a>
                      </label>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          @else
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label col-md-3">Membership Plan</label>
                  <label class="col-md-9 form-control-static">
                    {{ $registration->membership_full_name }}
                  </label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label col-md-3">Payment Method</label>
                  <label class="col-md-9 form-control-static">
                    {{ isset($payment_methods[$registration->payment_method]) ? $payment_methods[$registration->payment_method] : '' }}
                  </label>
                </div>
              </div>
            </div>
          @endif

          @if($will_be_admin)
            <div class="alert alert-info">
              As this registration is the first for this company, upon approval, he will be an admin of the company.
            </div>
          @endif

          @if($registration->approved == false)
            <div class="form-actions">
              <div class="row">
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                      <button type="submit" class="btn green">Approve</button>
                    </div>
                  </div>
                </div>
                <div class="col-md-6"> </div>
              </div>
            </div>
          @endif
        </div>
      </form>
    </div>
  </div>
@endsection