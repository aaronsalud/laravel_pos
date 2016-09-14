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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('category', 'CategoryController@index');
Route::get('item', 'ItemController@index');
Route::get('supplier', 'SupplierController@index');
Route::get('customer', 'CustomerController@index');
Route::get('purchase', 'PurchaseController@create');
