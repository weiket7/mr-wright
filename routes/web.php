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

Route::get('sale', 'SaleController@index');
Route::get('test', 'SiteController@test');
