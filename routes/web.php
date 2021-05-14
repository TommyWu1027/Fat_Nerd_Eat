<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// store
Route::get('/addstore', 'StoreController@addstore')->name('addstore');
Route::post('/storePost', 'StoreController@storePost')->name('storePost');
Route::get('/storelist', "StoreController@index");
Route::get('/dishPost', 'StoreController@dishPost')->name('dishPost');
Route::post('/dishPost_add', 'StoreController@dishPost_add')->name('dishPost_add');

// deliver
Route::get('/adddeliver', 'DeliverController@add_deliver')->name('adddeliver');
Route::post('/deliverPost', 'DeliverController@deliverPost')->name('deliverPost');

// customer
Route::get('/addcustomer', 'CustomerController@add_customer')->name('addcustomer');
Route::post('/customerPost', 'CustomerController@customerPost')->name('customerPost');