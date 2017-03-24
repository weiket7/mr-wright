<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use App\Models\Requester;
use App\Models\Services\TicketService;
use App\Models\Services\WorkingHourService;
use App\Models\User;
use Carbon\Carbon;

Route::get('/', 'SiteController@index');
Route::get('login', 'SiteController@login');
Route::get('logout', 'SiteController@logout');
Route::post('login', 'SiteController@login');
Route::get('error', 'SiteController@error');
Route::get('site/mail', 'SiteController@mail'); //TODO remove

Route::get('product', 'ProductController@index');
Route::get('product/save', 'ProductController@save');
Route::post('product/save', 'ProductController@save');
Route::get('product/save/{id}', 'ProductController@save');
Route::post('product/save/{id}', 'ProductController@save');

Route::get('company', 'CompanyController@index');
Route::post('company', 'CompanyController@index');
Route::get('company/save', 'CompanyController@save');
Route::post('company/save', 'CompanyController@save');
Route::get('company/save/{id}', 'CompanyController@save');
Route::post('company/save/{id}', 'CompanyController@save');

Route::get('office', 'OfficeController@index');
Route::post('office', 'OfficeController@index');
Route::get('office/save', 'OfficeController@save');
Route::post('office/save', 'OfficeController@save');
Route::get('office/save/{id}', 'OfficeController@save');
Route::post('office/save/{id}', 'OfficeController@save');

Route::get('requester', 'RequesterController@index');
Route::post('requester', 'RequesterController@index');
Route::get('requester/save', 'RequesterController@save');
Route::post('requester/save', 'RequesterController@save');
Route::get('requester/save/{id}', 'RequesterController@save');
Route::post('requester/save/{id}', 'RequesterController@save');

Route::get('operator', 'OperatorController@index');
Route::get('operator/save', 'OperatorController@save');
Route::post('operator/save', 'OperatorController@save');
Route::get('operator/save/{id}', 'OperatorController@save');
Route::post('operator/save/{id}', 'OperatorController@save');

Route::get('ticket', 'TicketController@index');
Route::post('ticket', 'TicketController@index');
Route::get('ticket/save', 'TicketController@save');
Route::post('ticket/save', 'TicketController@save');
Route::get('ticket/save/{id}', 'TicketController@save');
Route::post('ticket/save/{id}', 'TicketController@save');

Route::get('ticket/accept/{id}', 'TicketController@accept');
Route::post('ticket/accept/{id}', 'TicketController@accept');
Route::get('ticket/decline/{id}', 'TicketController@decline');
Route::post('ticket/decline/{id}', 'TicketController@decline');

Route::get('quotation', 'QuotationController@index');
Route::get('quotation/save', 'QuotationController@save');
Route::post('quotation/save', 'QuotationController@save');
Route::get('quotation/save/{id}', 'QuotationController@save');
Route::post('quotation/save/{id}', 'QuotationController@save');

Route::get('staff', 'StaffController@index');
Route::get('staff/save', 'StaffController@save');
Route::post('staff/save', 'StaffController@save');
Route::get('staff/save/{id}', 'StaffController@save');
Route::post('staff/save/{id}', 'StaffController@save');

Route::get('skill', 'SkillController@index');
Route::get('skill/save', 'SkillController@save');
Route::post('skill/save', 'SkillController@save');
Route::get('skill/save/{id}', 'SkillController@save');
Route::post('skill/save/{id}', 'SkillController@save');

Route::get('report/ticket', 'ReportController@ticket');
Route::post('report/ticket', 'ReportController@ticket');

Route::get('working-day-time', 'WorkingHourController@workingDaytime');
Route::get('blocked-date', 'WorkingHourController@blockedDate');
Route::get('blocked-date-time', 'WorkingHourController@blockedDateTime');
Route::get('category-for-ticket', 'SiteController@categoryForTicket');
Route::get('setting', 'SiteController@setting');
Route::get('system', 'SiteController@system');


Route::get('api/getStaffCalendar', 'ApiController@getStaffCalendar');
Route::get('api/getStaffWithSkills', 'ApiController@getStaffWithSkills');
Route::get('api/getOfficeByCompany', 'ApiController@getOfficeByCompany');
Route::get('api/getRequesterByOffice', 'ApiController@getRequesterByOffice');

Route::get('test', function() {
  $working_hour_service = new WorkingHourService();
  $ticket_service = new TicketService($working_hour_service);
  $ticket = $ticket_service->getTicket(1);
  var_dump($ticket->requested_by);
  var_dump(Requester::where('username',$ticket->requested_by)->first());

  var_dump(User::where(['username'=>$ticket->requested_by])->first());

  $res = $ticket_service->getNextTicketCode(1);
  var_dump(date('d M Y'));

  $start_of_month = Carbon::now()->startOfMonth();
  echo       $month = $start_of_month->month;
  
  
  $json = '{"1":["10:15","10:30"],"2":["10:15","10:30"]}';
  echo $json;
  $res = json_decode($json, true);
  var_dump($res);

  $a = [
    1=>['2017-03-07'=>['10:15', '10:30', '10:45'], '2017-03-08'=>['10:15', '10:30', '10:45']],
    2=>['2017-03-07'=>['10:15', '10:30', '10:45'], '2017-03-08'=>['10:15', '10:30', '10:45']]
  ];
  var_dump($a);
  $res = json_encode($a);
  echo 'encode=' . $res;

  $working_hour_service = new WorkingHourService();

  /*$data = ['10:30', '10:45', '11:00', '12:00', '12:15'];
  $res = $working_hour_service->mergeIntervalsIntoTimeRange($data);
  var_dump($res);

  $today = Carbon::now()->format("Y-m-d");
  $next_monday = Carbon::parse('next monday')->format("Y-m-d");
  echo 'next mon'; var_dump($next_monday);

  $res = $working_hour_service->getWorkingIntervalsByDate($today);
  echo 'res'; var_dump($res);
  $res = $working_hour_service->isDateBlocked($today);
  echo 'res'; var_dump($res);
  $res = $working_hour_service->getBlockedWorkingIntervalsByDate($today);
  echo 'res'; var_dump($res);

  $res = $working_hour_service->getWorkingIntervalsByDate($next_monday);
  echo 'res'; var_dump($res);
  $res = $working_hour_service->isDateBlocked($next_monday);
  echo 'res'; var_dump($res);
  $res = $working_hour_service->getBlockedWorkingIntervalsByDate($next_monday);
  echo 'res'; var_dump($res);*/

});


Route::get('/home', 'HomeController@index');
