<?php use App\Models\Enums\RequesterStat; ?>
<?php use App\Models\Enums\PreferredContact; ?>

@extends("template")

@section('content')
  <h1 class="page-title">
    {{ucfirst($action)}} Requester
  </h1>

  <div class="portlet light bordered" id="app">
    <div class="portlet-body form">
      <form action="" method="post" class="form-horizontal">
        {!! csrf_field() !!}
        <div class="form-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Name</label>
                <div class="col-md-9">
                  {{Form::text('name', $requester->name, ['class'=>'form-control'])}}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Status</label>
                <div class="col-md-9">
                  {{Form::select('stat', RequesterStat::$values, $requester->stat, ['class'=>'form-control', 'placeholder'=>''])}}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Company</label>
                <div class="col-md-9">
                  {{Form::select('company_id', $companies, $requester->company_id, ['id'=>'company_id', 'class'=>'form-control', 'placeholder'=>''])}}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Office</label>
                <div class="col-md-9">
                  {{Form::select('office_id', $offices, $requester->office_id, ['id'=>'office_id', 'class'=>'form-control', 'placeholder'=>''])}}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Designation</label>
                <div class="col-md-9">
                  {{Form::text('designation', $requester->designation, ['class'=>'form-control'])}}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Email</label>
                <div class="col-md-9">
                  {{Form::text('email', $requester->email, ['class'=>'form-control'])}}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Mobile</label>
                <div class="col-md-9">
                  {{Form::text('mobile', $requester->mobile, ['class'=>'form-control'])}}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Work</label>
                <div class="col-md-9">
                  {{Form::text('work', $requester->work, ['class'=>'form-control'])}}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3">Preferred Contact</label>
                <div class="col-md-9">
                  {{Form::select('preferred_contact', PreferredContact::$values, $requester->preferred_contact, ['class'=>'form-control', 'placeholder'=>''])}}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label col-md-3"></label>
                <div class="col-md-9">
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
  </div>
@endsection

@section('script')
  <script>
    $(document).ready(function() {
      $("#company_id").change(function() {
        var company_id = $(this).val();
        axios.get('{{url('api/getOfficeByCompany')}}?company_id='+company_id)
        .then(function (response) {
          var offices = response.data;
          var html = '<option></option>';
          for (var office_id in offices) {
            if (offices.hasOwnProperty(office_id)) {
              html += "<option value="+office_id+">" + offices[office_id] + "</option>";
            }
          }
          $("#office_id").html(html);
        })
        .catch(function (error) {
          console.log('company_id error='+error);
        })
      });
    });
  </script>

@endsection