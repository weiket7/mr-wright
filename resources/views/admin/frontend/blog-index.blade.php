@extends("admin.template")

@section("content")
  <div class="row">
    <div class="col-md-6">
      <h1 class="page-title">Blogs</h1>
    </div>
    <div class="col-xs-6 text-right">
      <button type="button" class="btn blue" onclick="location.href='{{url('admin/frontend/blog/save')}}'">Create</button>
    </div>
  </div>
  
  <div class="portlet light bordered">
    <div class="portlet-body">
      <div>
        <table class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>Title</th>
            <th>Content</th>
            <th>URL</th>
            <th>Status</th>
          </tr>
          </thead>
          <tbody>
          @foreach($blogs as $blog)
            <tr>
              <td><a href="{{url("admin/frontend/blog/save/".$blog->frontend_blog_id)}}">{{ $blog->title }}</a></td>
              <td>{!! str_limit($blog->content, 200) !!}</td>
              <td>{{ $blog->url }}</td>
              <td>{{ $blog->stat ? 'Enabled' : 'Disabled'}}</td>
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