<p>
  <h1>No show</h1>

  <table>
    <thead>
    <tr>
      <th>Ticket Code</th>
      <th>Date</th>
      <th>Time Start</th>
      <th>Time End</th>
    </tr>
    </thead>
    @foreach($no_shows as $n)
    <tr>
      <td>{{ $n->ticket_code }}</td>
      <td>{{ ViewHelper::formatDate($n->date) }}</td>
      <td>{{ ViewHelper::formatTime($n->time_start) }}</td>
      <td>{{ ViewHelper::formatTime($n->time_end) }}</td>
    </tr>
    @endforeach
  </table>
</p>