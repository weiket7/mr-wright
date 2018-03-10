<?php use App\Models\Enums\CompanyStat; ?>

@extends("admin.template")

@section("content")
  <div class="row">
    <div class="col-md-6">
      <h1 class="page-title">Dynamics</h1>
    </div>
  </div>
  
  
  <div class="portlet light bordered">
    <div class="portlet-body">
      <div>
        <table class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>Position</th>
            <th>Title</th>
            <th>Content</th>
            <th>Button Text</th>
            <th>Button Link</th>
            <th>Image</th>
          </tr>
          </thead>
          <tbody>
          @foreach($dynamics as $dynamic)
            <tr>
              <td><a href="{{url("admin/frontend/dynamic/save/".$dynamic->frontend_dynamic_id)}}">{{ $dynamic->title }}</a></td>
              <td>{{ $dynamic->content }}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
        
        <div class="row">
          <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-success">Save</button>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    $(document).ready(function() {
      $("tbody").sortable({
        stop: function(event, ui) {
          var i = 1;
          $('tbody > tr').each(function() {
            $(this).find("input[type='text']").val(i);
            i++;
          });
        }
      });
    });
  </script>
@endsection