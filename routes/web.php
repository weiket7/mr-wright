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

use App\Mail\TestEmail;
use App\Models\User;
use Carbon\Carbon;


Route::get('/', 'Frontend\SiteController@index');
Route::get('home', 'Frontend\SiteController@index');
Route::get('register', 'Frontend\SiteController@register');
Route::post('register', 'Frontend\SiteController@register');
Route::get('register-success', 'Frontend\SiteController@registerSuccess');
Route::get('register-existing-uen', 'Frontend\SiteController@registerExistingUen');
Route::post('register-existing-uen', 'Frontend\SiteController@registerExistingUen');
Route::get('contact', 'Frontend\SiteController@contact');
Route::post('contact', 'Frontend\SiteController@contact');
Route::get('about', 'Frontend\SiteController@about');
Route::get('pricing', 'Frontend\SiteController@pricing');
Route::get('services', 'Frontend\SiteController@service');
Route::get('services/{slug}', 'Frontend\SiteController@service');
Route::get('projects', 'Frontend\SiteController@project');


Route::get('login', 'Frontend\SiteController@login');
Route::post('login', 'Frontend\SiteController@login');
Route::get('logout', 'Frontend\SiteController@logout');
Route::get('error', 'Frontend\SiteController@error');

Route::get('admin', 'Admin\AdminController@login');
Route::post('admin', 'Admin\AdminController@login');
Route::get('admin/login', 'Admin\AdminController@login');
Route::post('admin/login', 'Admin\AdminController@login');
Route::get('admin/logout', 'Admin\AdminController@logout');
Route::get('admin/error', 'Admin\AdminController@error');

Route::group(['middleware'=>['auth']], function() {
  Route::get('account', 'Frontend\SiteController@account');
  Route::post('account', 'Frontend\SiteController@account');

  Route::get('office/save', 'Frontend\SiteController@saveOffice');
  Route::post('office/save', 'Frontend\SiteController@saveOffice');
  Route::get('office/save/{id}', 'Frontend\SiteController@saveOffice');
  Route::post('office/save/{id}', 'Frontend\SiteController@saveOffice');

  Route::group(['middleware'=>['modulemiddleware']], function() {
    Route::get('admin/dashboard', 'Admin\AdminController@dashboard');
    Route::get('admin/company', 'Admin\CompanyController@index');
    Route::post('admin/company', 'Admin\CompanyController@index');
    Route::get('admin/company/save', 'Admin\CompanyController@save');
    Route::post('admin/company/save', 'Admin\CompanyController@save');
    Route::get('admin/company/save/{id}', 'Admin\CompanyController@save');
    Route::post('admin/company/save/{id}', 'Admin\CompanyController@save');
    
    Route::get('admin/membership', 'Admin\MembershipController@index');
    Route::post('admin/membership', 'Admin\MembershipController@index');
    Route::get('admin/membership/save', 'Admin\MembershipController@save');
    Route::post('admin/membership/save', 'Admin\MembershipController@save');
    Route::get('admin/membership/save/{id}', 'Admin\MembershipController@save');
    Route::post('admin/membership/save/{id}', 'Admin\MembershipController@save');
    
    Route::get('admin/office', 'Admin\OfficeController@index');
    Route::post('admin/office', 'Admin\OfficeController@index');
    Route::get('admin/office/save', 'Admin\OfficeController@save');
    Route::post('admin/office/save', 'Admin\OfficeController@save');
    Route::get('admin/office/save/{id}', 'Admin\OfficeController@save');
    Route::post('admin/office/save/{id}', 'Admin\OfficeController@save');
    
    Route::get('admin/requester', 'Admin\RequesterController@index');
    Route::post('admin/requester', 'Admin\RequesterController@index');
    Route::get('admin/requester/save', 'Admin\RequesterController@save');
    Route::post('admin/requester/save', 'Admin\RequesterController@save');
    Route::get('admin/requester/save/{id}', 'Admin\RequesterController@save');
    Route::post('admin/requester/save/{id}', 'Admin\RequesterController@save');
    
    Route::get('admin/operator', 'Admin\OperatorController@index');
    Route::get('admin/operator/save', 'Admin\OperatorController@save');
    Route::post('admin/operator/save', 'Admin\OperatorController@save');
    Route::get('admin/operator/save/{id}', 'Admin\OperatorController@save');
    Route::post('admin/operator/save/{id}', 'Admin\OperatorController@save');
    
    Route::get('admin/ticket', 'Admin\TicketController@index');
    Route::post('admin/ticket', 'Admin\TicketController@index');
    Route::get('admin/ticket/save', 'Admin\TicketController@save');
    Route::post('admin/ticket/save', 'Admin\TicketController@save');
    Route::get('admin/ticket/view/{id}', 'Admin\TicketController@view');
    Route::post('admin/ticket/view/{id}', 'Admin\TicketController@view');
    Route::get('admin/ticket/save/{id}', 'Admin\TicketController@save');
    Route::post('admin/ticket/save/{id}', 'Admin\TicketController@save');
    Route::get('admin/ticket/preview-quotation/{id}', 'Admin\TicketController@previewQuotation');
    Route::get('admin/ticket/preview-invoice/{id}', 'Admin\TicketController@previewInvoice');
    
    Route::get('admin/staff', 'Admin\StaffController@index');
    Route::get('admin/staff/save', 'Admin\StaffController@save');
    Route::post('admin/staff/save', 'Admin\StaffController@save');
    Route::get('admin/staff/save/{id}', 'Admin\StaffController@save');
    Route::post('admin/staff/save/{id}', 'Admin\StaffController@save');
    
    Route::get('admin/skill', 'Admin\SkillController@index');
    Route::get('admin/skill/save', 'Admin\SkillController@save');
    Route::post('admin/skill/save', 'Admin\SkillController@save');
    Route::get('admin/skill/save/{id}', 'Admin\SkillController@save');
    Route::post('admin/skill/save/{id}', 'Admin\SkillController@save');
    
    Route::get('admin/invoice', 'Admin\InvoiceController@index');
    Route::post('admin/invoice', 'Admin\InvoiceController@index');
    
    Route::get('admin/report/ticket', 'Admin\ReportController@ticket');
    Route::post('admin/report/ticket', 'Admin\ReportController@ticket');
    
    Route::get('admin/working-day-time', 'Admin\WorkingHourController@workingDaytime');
    Route::get('admin/blocked-date', 'Admin\WorkingHourController@blockedDate');
    Route::get('admin/blocked-date-time', 'Admin\WorkingHourController@blockedDateTime');
    Route::get('admin/category-for-ticket', 'Admin\SettingController@categoryForTicket');
    Route::get('admin/system', 'Admin\SettingController@system');
    Route::get('admin/setting', 'Admin\SettingController@setting');
    Route::get('admin/access', 'Admin\SettingController@access');
    
    Route::get('admin/role', 'Admin\RoleController@index');
    Route::get('admin/role/save', 'Admin\RoleController@save');
    Route::post('admin/role/save', 'Admin\RoleController@save');
    Route::get('admin/role/save/{id}', 'Admin\RoleController@save');
    Route::post('admin/role/save/{id}', 'Admin\RoleController@save');
    
    Route::get('admin/content', 'Admin\FrontendController@content');
    Route::get('admin/banner', 'Admin\FrontendController@banner');
    Route::get('admin/service', 'Admin\FrontendController@service');
    Route::get('admin/project', 'Admin\FrontendController@project');
  });
  
  Route::group(['middleware'=>['frontendticketmiddleware']], function() {
    Route::get('ticket', 'Frontend\TicketController@index');
    Route::get('ticket/save', 'Frontend\TicketController@save');
    Route::post('ticket/save', 'Frontend\TicketController@save');
    Route::get('ticket/save/{id}', 'Frontend\TicketController@save');
    Route::post('ticket/save/{id}', 'Frontend\TicketController@save');
    Route::get('ticket/view/{id}', 'Frontend\TicketController@view');
    Route::post('ticket/view/{id}', 'Frontend\TicketController@view');
    
    Route::get('ticket/pay/{id}', 'TicketController@view');
    Route::post('ticket/pay/{id}', 'TicketController@view');
  });
  
  Route::get('api/getStaffCalendar', 'ApiController@getStaffCalendar');
  Route::get('api/getStaffWithSkills', 'ApiController@getStaffWithSkills');
  Route::get('api/getOfficeByCompany', 'ApiController@getOfficeByCompany');
  Route::get('api/getOffice', 'ApiController@getOffice');
  Route::get('api/getRequesterByOffice', 'ApiController@getRequesterByOffice');
});

Route::get('api/uenExist', 'ApiController@uenExist');

Route::get('test', function() {
  Mail::to(User::first())
    //send(new QuotationMail($ticket_id));
    ->queue(new TestEmail());
  
  return "Email will be sent 5 seconds later";
});


Route::get('/home', 'HomeController@index');
