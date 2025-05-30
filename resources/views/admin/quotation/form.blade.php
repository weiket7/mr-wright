@extends("admin.template")

@section('content')
  <div class="portlet light bordered">
    <div class="portlet-body form">
      <div class="tabbable">
        <ul class="nav nav-tabs">
          <li class="active">
            <a href="#tab-general" data-toggle="tab">
              General </a>
          </li>
          <li>
            <a href="#tab-myTab" data-toggle="tab">Tab</a>
          </li>
        </ul>
        <div class="tab-content no-space">
          <div class="tab-pane fade active in" id="tab-general">
            <form action="" method="post" class="form-horizontal">
              {!! csrf_field() !!}
              <div class="form-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label col-md-3">Name</label>
                      <div class="col-md-9">
                        {{Form::text('name', $product->name, ['class'=>'form-control'])}}
                        <span class="help-block"> This is inline help </span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group has-error">
                      <label class="control-label col-md-3">Code</label>
                      <div class="col-md-9">
                        {{Form::text('code', $product->code, ['class'=>'form-control'])}}
                      </div>
                    </div>
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
          <div class="tab-pane fade" id="tab-myTab">
            <table class="table table-bordered">
              <thead>
              <tr>
                <td width="100">Name</td>
                <td>Discounted Price</td>
              </tr>
              </thead>
              <tbody>
              
              </tbody>
            </table>
          </div>
        
        </div>
      </div>
    </div>
  </div>
@endsection