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

use App\Models\Services\WorkingHourService;
use Carbon\Carbon;

Route::get('/', 'SiteController@index');
Route::get('site/mail', 'SiteController@mail');

Route::get('product', 'ProductController@index');
Route::get('product/save', 'ProductController@save');
Route::post('product/save', 'ProductController@save');
Route::get('product/save/{id}', 'ProductController@save');
Route::post('product/save/{id}', 'ProductController@save');

Route::get('company', 'CompanyController@index');
Route::get('company/save', 'CompanyController@save');
Route::post('company/save', 'CompanyController@save');
Route::get('company/save/{id}', 'CompanyController@save');
Route::post('company/save/{id}', 'CompanyController@save');

Route::get('requester', 'RequesterController@index');
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

Route::get('api/getStaffCalendar', 'ApiController@getStaffCalendar');
Route::get('api/getStaffWithSkills', 'ApiController@getStaffWithSkills');

Route::get('test', function() {
  $ticket_issue = [
    'ticket_id'=>1,
    'issue_desc' => 2,
    'expected_desc' => 3,
  ];
  DB::table('ticket_issue')->update($ticket_issue);

  $working_hour_service = new WorkingHourService();
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
  echo 'res'; var_dump($res);

});

Auth::routes();

Route::get('/home', 'HomeController@index');
