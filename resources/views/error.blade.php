@extends("template")

@section('content')
  <h1 class="page-title">
    Error
  </h1>

  <div class="portlet light bordered">
    <div class="portlet-body form">
      <div class="alert alert-danger">
        {{ Session::get('error') }}
      </div>
    </div>
  </div>

@endsection