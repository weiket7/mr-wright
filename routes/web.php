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

Route::get('/', 'SiteController@index');

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

Route::get('ticket', 'TicketController@index');
Route::get('ticket/save', 'TicketController@save');
Route::post('ticket/save', 'TicketController@save');
Route::get('ticket/save/{id}', 'TicketController@save');
Route::post('ticket/save/{id}', 'TicketController@save');

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

Route::get('sale', 'SaleController@index');
Route::get('test', function() {
  $working_hour_service = new WorkingHourService();
  $res = $working_hour_service->splitTimeRangeIntoInterval('07:00:00', '09:00:00', 15);
  $expected = ['07:00', '07:15', '07:30', '07:45', '08:00', '08:15', '08:30', '08:45'];
  echo 'expected'; var_dump($expected);
  echo 'res'; var_dump($res);

  $res = $working_hour_service->getAvailableWorkingDayTimes();
  echo 'res'; var_dump($res);

  $res = $working_hour_service->getAvailableWorkingSlots();
  echo 'res'; var_dump($res);

  $res = $working_hour_service->getBlockedWorkingDays();
  echo 'res'; var_dump($res);

  echo '<h1>final</h1>';
  $res = $working_hour_service->getAvailableWorkingSlots();
  var_dump($res);

});
