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

use App\Mail\QuotationMail;
use App\Models\Enums\Role;
use App\Models\Helpers\BackendHelper;
use App\Models\Requester;
use App\Models\Services\TicketService;
use App\Models\Services\WorkingHourService;
use App\Models\User;
use Carbon\Carbon;


Route::get('/', 'Frontend\SiteController@index');
Route::get('register', 'Frontend\SiteController@register');
Route::get('contact', 'Frontend\SiteController@contact');
Route::get('about', 'Frontend\SiteController@about');

Route::get('admin', 'AdminController@login');
Route::post('admin', 'AdminController@login');
Route::get('admin/login', 'AdminController@login');
Route::post('admin/login', 'AdminController@login');
Route::get('admin/logout', 'AdminController@logout');
Route::get('admin/error', 'AdminController@error');

Route::group(['middleware'=>['auth', 'modulemiddleware']], function() {
  Route::get('dashboard', 'AdminController@dashboard');
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
  Route::get('ticket/view/{id}', 'TicketController@view');
  Route::post('ticket/view/{id}', 'TicketController@view');
  Route::get('ticket/save/{id}', 'TicketController@save');
  Route::post('ticket/save/{id}', 'TicketController@save');
  Route::get('ticket/preview-quotation/{id}', 'TicketController@previewQuotation');
  Route::get('ticket/preview-invoice/{id}', 'TicketController@previewInvoice');

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

  Route::get('invoice', 'InvoiceController@index');
  Route::post('invoice', 'InvoiceController@index');

  Route::get('report/ticket', 'ReportController@ticket');
  Route::post('report/ticket', 'ReportController@ticket');

  Route::get('working-day-time', 'WorkingHourController@workingDaytime');
  Route::get('blocked-date', 'WorkingHourController@blockedDate');
  Route::get('blocked-date-time', 'WorkingHourController@blockedDateTime');
  Route::get('category-for-ticket', 'SettingController@categoryForTicket');
  Route::get('system', 'SettingController@system');
  Route::get('setting', 'SettingController@setting');
  Route::get('access', 'SettingController@access');

  Route::get('role', 'RoleController@index');
  Route::get('role/save', 'RoleController@save');
  Route::post('role/save', 'RoleController@save');
  Route::get('role/save/{id}', 'RoleController@save');
  Route::post('role/save/{id}', 'RoleController@save');

  Route::get('api/getStaffCalendar', 'ApiController@getStaffCalendar');
  Route::get('api/getStaffWithSkills', 'ApiController@getStaffWithSkills');
  Route::get('api/getOfficeByCompany', 'ApiController@getOfficeByCompany');
  Route::get('api/getRequesterByOffice', 'ApiController@getRequesterByOffice');

  //TODO
  Route::get('ticket/accept/{id}', 'TicketController@view');
  Route::post('ticket/accept/{id}', 'TicketController@view');
  Route::get('ticket/decline/{id}', 'TicketController@view');
  Route::post('ticket/decline/{id}', 'TicketController@view');

  Route::get('ticket/pay/{id}', 'TicketController@view');
  Route::post('ticket/pay/{id}', 'TicketController@view');
});

Route::get('test', function() {
  $working_hour_service = new WorkingHourService();
  $ticket_service = new TicketService($working_hour_service);
  $ticket = $ticket_service->getTicket(1);
  //Mail::to($user = Requester::where('username', $ticket->requested_by)->first())->send(new QuotationMail($ticket));

  var_dump(Role::$values);

  $res = BackendHelper::dateBeforeDateInclusive('2017-04-02 00:00:00', '2017-04-01');
  var_dump($res);
});


Route::get('/home', 'HomeController@index');
