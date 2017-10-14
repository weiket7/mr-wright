@extends("emails.email-template")

@section('content')
  <h3>Invite to Mr Wright</h3>

  You have been invited to Mr Wright at mrwright.sg.
  <br><br>
  Upon accepting, you will be able to create tickets requesting for repair services from Mr Wright.
  <br><br>

  <a href="{{url('members/invite/'.$token)}}" class="btn btn-primary">Accept Invite</a>
@endsection