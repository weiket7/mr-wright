<?php

namespace App\Http\Controllers;

use App;
use App\Mail\QuotationMail;
use App\Models\Services\TicketService;
use App\Models\Ticket;
use App\Models\User;
use Mail;

class SiteController extends Controller
{
  protected $ticket_service;

  public function __construct(TicketService $ticket_service)
  {
    $this->ticket_service = $ticket_service;
  }

  public function index()
  {
    //$product = DB::collection('product')->get();
    //var_dump($product); exit;
    return view("index");
  }

  public function login() {
    
  }

  public function mail() {
    //echo App::environment('local');
    $ticket = $this->ticket_service->getTicket(1);
    $data['ticket'] = $ticket;
    //return view('emails/quotation', $data);
    //https://laracasts.com/series/laravel-from-scratch-2017/episodes/27
    Mail::to($user = User::first())->send(new QuotationMail($ticket));
  }

  public function categoryForTicket() {
    $data['categories'] = $this->ticket_service->getCategoryDropdown();
    return view('site/category-for-ticket', $data);

  }

  public function setting() {
    return view('site/setting');
  }

  public function system() {
    return view('site/system');
  }
}
  
  