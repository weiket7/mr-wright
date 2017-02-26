<?php

namespace App\Http\Controllers;

use App;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
  public function index()
  {
    $data['tickets'] = Ticket::all();
    return view("ticket/index", $data);
  }
  
  public function save(Request $request, $ticket_id = null) {
    $data['ticket'] = $ticket_id == null ? new Ticket() : Ticket::find($ticket_id);
    return view('ticket/form', $data);
  }
  
}