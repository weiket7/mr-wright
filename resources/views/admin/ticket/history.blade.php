
<ul class="list-group">
  @foreach($ticket->history as $h)
    <li class="list-group-item">
      <b>@if ($h->action == 'pay')
        Paid
      @elseif ($h->action == 'invoice')
        Invoiced
      @elseif ($h->action == 'complete')
        Completed
      @elseif ($h->action == 'firstOtp')
        First OTP entered
      @elseif ($h->action == 'secondOtp')
        Second OTP entered
      @elseif ($h->action == 'decline')
        Declined
      @elseif ($h->action == 'accept')
        Accepted
      @elseif ($h->action == 'quote')
        Quoted
      @elseif ($h->action == 'open')
        Opened
      @elseif ($h->action == 'draft')
        Drafted
      @endif</b>
      by {{ $h->action_by }} on {{ ViewHelper::formatDateTime($h->action_on) }}
    </li>
  @endforeach
</ul>