<?php use App\Models\Enums\CompanyStat; ?>

@extends("template")

@section('content')
  <h1 class="page-title">
    {{ucfirst($action)}} Company
  </h1>

  <div class="portlet light bordered">
    <div class="portlet-body form">
      <form action="" method="post" class="form-horizontal">
        {!! csrf_field() !!}
        <div class="form-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Code</label>
                <div class="col-md-9">
                  {{Form::text('code', $company->code, ['class'=>'form-control'])}}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Status</label>
                <div class="col-md-9">
                  {{Form::select('stat', CompanyStat::$values, $company->stat, ['class'=>'form-control', 'placeholder'=>''])}}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Name</label>
                <div class="col-md-9">
                  {{Form::text('name', $company->name, ['class'=>'form-control'])}}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Registered Name</label>
                <div class="col-md-9">
                  {{Form::text('code', $company->code, ['class'=>'form-control'])}}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Address</label>
                <div class="col-md-9">
                  {{Form::textarea('addr', $company->addr, ['class'=>'form-control', 'rows'=>3])}}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Country</label>
                <div class="col-md-9">
                  {{Form::text('country', $company->country, ['class'=>'form-control'])}}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">State</label>
                <div class="col-md-9">
                  {{Form::text('state', $company->state, ['class'=>'form-control'])}}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">City</label>
                <div class="col-md-9">
                  {{Form::text('city', $company->city, ['class'=>'form-control'])}}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Postal</label>
                <div class="col-md-9">
                  {{Form::text('postal', $company->postal, ['class'=>'form-control'])}}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Industry</label>
                <div class="col-md-9">
                  {{Form::text('code', $company->code, ['class'=>'form-control'])}}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Logo</label>
                <div class="col-md-9">
                  <input type="file" name="logo">
                </div>
              </div>
            </div>
            <div class="col-md-6">
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Office</label>
                <div class="col-md-9">
                  <table class="table table-bordered no-margin-btm">
                    @foreach($company->offices as $o)
                      <tr>
                        <td>{{ $o->name }}</td>
                      </tr>
                    @endforeach
                  </table>
                </div>
              </div>
            </div>
            <div class="col-md-6">
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