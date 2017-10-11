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

Route::get('/', 'Frontend\SiteController@index');
Route::get('home', 'Frontend\SiteController@index');

Route::get('register', 'Frontend\RegistrationController@index');
Route::post('register', 'Frontend\RegistrationController@index');
Route::get('register/existing-uen', 'Frontend\RegistrationController@existingUen');
Route::post('register/existing-uen', 'Frontend\RegistrationController@existingUen');
Route::get('register/membership', 'Frontend\RegistrationController@membership');
Route::post('register/membership', 'Frontend\RegistrationController@membership');
Route::get('register/payment', 'Frontend\RegistrationController@payment');
Route::get('register/success', 'Frontend\RegistrationController@success');
Route::get('members/invite/{id}', 'Frontend\SiteController@membersInvite');
Route::post('members/invite/{id}', 'Frontend\SiteController@membersInvite');

Route::get('payment', 'Frontend\PaymentController@index');
Route::get('payment/process', 'Frontend\PaymentController@process');
Route::post('payment/callback', 'Frontend\PaymentController@callback');
Route::get('payment/cancel', 'Frontend\PaymentController@cancel');
Route::get('payment/fail', 'Frontend\PaymentController@fail');

Route::get('contact', 'Frontend\SiteController@contact');
Route::post('contact', 'Frontend\SiteController@contact');
Route::get('about', 'Frontend\SiteController@about');
Route::get('membership', 'Frontend\SiteController@membership');
Route::get('services', 'Frontend\SiteController@service');
Route::get('services/{slug}', 'Frontend\SiteController@service');
Route::get('projects', 'Frontend\SiteController@project');

Route::get('login', 'Frontend\SiteController@login');
Route::post('login', 'Frontend\SiteController@login');
Route::get('forgot-password', 'Frontend\SiteController@forgotPassword');
Route::post('forgot-password', 'Frontend\SiteController@forgotPassword');
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
  
  Route::group(['middleware'=>['frontendmiddleware']], function() {
    Route::get('membership/upgrade', 'Frontend\SiteController@membershipUpgrade');
    
    Route::get('members', 'Frontend\SiteController@members');
    Route::post('members', 'Frontend\SiteController@members');
    Route::get('members/save', 'Frontend\SiteController@membersSave');
    Route::post('members/save', 'Frontend\SiteController@membersSave');
    Route::get('members/save/{id}', 'Frontend\SiteController@membersSave');
    Route::post('members/save/{id}', 'Frontend\SiteController@membersSave');
    Route::get('members/registration/{id}', 'Frontend\SiteController@membersRegistration');
    Route::post('members/registration/{id}', 'Frontend\SiteController@membersRegistration');
    
    Route::get('office/save', 'Frontend\SiteController@officeSave');
    Route::post('office/save', 'Frontend\SiteController@officeSave');
    Route::get('office/save/{id}', 'Frontend\SiteController@officeSave');
    Route::post('office/save/{id}', 'Frontend\SiteController@officeSave');
    
    Route::get('ticket', 'Frontend\TicketController@index');
    Route::get('ticket/save', 'Frontend\TicketController@save');
    Route::post('ticket/save', 'Frontend\TicketController@save');
    Route::get('ticket/save/{id}', 'Frontend\TicketController@save');
    Route::post('ticket/save/{id}', 'Frontend\TicketController@save');
    Route::get('ticket/view/{id}', 'Frontend\TicketController@view');
    Route::post('ticket/view/{id}', 'Frontend\TicketController@view');
    Route::get('ticket/pay/{id}', 'Frontend\TicketController@view');
    Route::post('ticket/pay/{id}', 'Frontend\TicketController@view');
  });
  
  Route::group(['middleware'=>['modulemiddleware']], function() {

    Route::get('admin/dashboard', 'Admin\AdminController@dashboard');
    Route::get('admin/company', 'Admin\CompanyController@index');
    Route::post('admin/company', 'Admin\CompanyController@index');
    Route::get('admin/company/save', 'Admin\CompanyController@save');
    Route::post('admin/company/save', 'Admin\CompanyController@save');
    Route::get('admin/company/save/{id}', 'Admin\CompanyController@save');
    Route::post('admin/company/save/{id}', 'Admin\CompanyController@save');

    Route::get('admin/registration', 'Admin\RegistrationController@index');
    Route::post('admin/registration', 'Admin\RegistrationController@index');
    Route::get('admin/registration/save/{id}', 'Admin\RegistrationController@save');
    Route::post('admin/registration/save/{id}', 'Admin\RegistrationController@save');
    
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
    Route::get('admin/category-for-ticket/save', 'Admin\SettingController@categoryForTicketSave');
    Route::post('admin/category-for-ticket/save', 'Admin\SettingController@categoryForTicketSave');
    Route::get('admin/category-for-ticket/save/{id}', 'Admin\SettingController@categoryForTicketSave');
    Route::post('admin/category-for-ticket/save/{id}', 'Admin\SettingController@categoryForTicketSave');
    
    Route::get('admin/payment-method', 'Admin\SettingController@paymentMethod');
    Route::post('admin/payment-method', 'Admin\SettingController@paymentMethod');
    Route::get('admin/setting', 'Admin\SettingController@setting');
    Route::get('admin/access', 'Admin\SettingController@access');
    
    Route::get('admin/role', 'Admin\RoleController@index');
    Route::get('admin/role/save', 'Admin\RoleController@save');
    Route::post('admin/role/save', 'Admin\RoleController@save');
    Route::get('admin/role/save/{id}', 'Admin\RoleController@save');
    Route::post('admin/role/save/{id}', 'Admin\RoleController@save');

    Route::get('admin/frontend/content', 'Admin\FrontendController@content');
    Route::get('admin/frontend/content/save/{id}', 'Admin\FrontendController@contentSave');
    Route::post('admin/frontend/content/save/{id}', 'Admin\FrontendController@contentSave');
    Route::get('admin/frontend/banner', 'Admin\FrontendController@banner');
    Route::get('admin/frontend/banner/save/{id}', 'Admin\FrontendController@bannerSave');
    Route::post('admin/frontend/banner/save/{id}', 'Admin\FrontendController@bannerSave');
    Route::get('admin/frontend/service', 'Admin\FrontendController@service');
    Route::get('admin/frontend/service/save/{id}', 'Admin\FrontendController@serviceSave');
    Route::post('admin/frontend/service/save/{id}', 'Admin\FrontendController@serviceSave');
    Route::get('admin/frontend/project', 'Admin\FrontendController@project');
    Route::get('admin/frontend/project/save/{id}', 'Admin\FrontendController@projectSave');
    Route::post('admin/frontend/project/save/{id}', 'Admin\FrontendController@projectSave');
  });
  
  Route::get('admin/staff/dashboard', 'Admin\StaffController@dashboard');
  Route::post('admin/staff/dashboard', 'Admin\StaffController@dashboard');
  Route::get('admin/staff/otp/{id}', 'Admin\StaffController@otp');
  
  Route::get('admin/system', 'Admin\SettingController@system');

  Route::get('api/enterOtp', 'ApiController@enterOtp');
  Route::get('api/getStaffCalendar', 'ApiController@getStaffCalendar');
  Route::get('api/getStaffWithSkills', 'ApiController@getStaffWithSkills');
  Route::get('api/getOfficeByCompany', 'ApiController@getOfficeByCompany');
  Route::get('api/getOffice', 'ApiController@getOffice');
  Route::get('api/getRequesterByOffice', 'ApiController@getRequesterByOffice');
});

//TODO secure this api
Route::get('api/transactionSuccess', 'ApiController@transactionSuccess');

//TODO remove
Route::get('preview', 'PreviewController@index');
Route::get('preview/quotation/{id}', 'PreviewController@previewQuotation');
Route::get('preview/invoice/{id}', 'PreviewController@previewInvoice');
Route::get('preview/register-existing-uen/{id}', 'PreviewController@registerExistingUen');
Route::get('preview/register-success/{id}', 'PreviewController@registerSuccess');
Route::get('preview/register-approve/{id}', 'PreviewController@registerApprove');
Route::get('preview/ticket-accept/{id}', 'PreviewController@ticketAccept');
Route::get('preview/invite', 'PreviewController@invite');
Route::get('preview/forgot-password', 'PreviewController@forgotPassword');

Route::get('test', function() {
  $ticket_service = new TicketService();
  $res = $ticket_service->getNextTicketCode(3);
  echo $res;
  //$user = User::where('username', 'weiket')->first();
  //Auth::login($user);
  
});


Route::get('/home', 'HomeController@index');
