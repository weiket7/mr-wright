@extends("admin.template")

@section('content')
  <h1 class="page-title">
    Error
  </h1>

  <div class="portlet light bordered">
    <div class="portlet-body form">
      <div class="alert alert-danger">
        @if(session()->has('error'))
          {{session()->get('error')}}
        @elseif(isset($error))
          {{ $error }}
        @else
          An error occurred
        @endif
      </div>
    </div>
  </div>

@endsection