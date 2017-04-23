@extends("emails.email-template")

@section('content')
  <h3>Invite to Mr Wright</h3>

  You have been invited to Mr Wright at mrwright.sg.
  <br><br>
  Upon accepting, you will be able to create tickets requesting for repair services from Mr Wright.
  <br><br>

  <div class="text-center">
    <button type='button' class="btn btn-primary" onclick="window.open('{{url('invite/accept/'.$token)}}')">Accept Invite</button>
  </div>
@endsection