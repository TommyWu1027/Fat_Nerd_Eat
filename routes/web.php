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

// deliver
Route::get('/adddeliver', 'DeliverController@add_deliver')->name('adddeliver');
Route::post('/deliverPost', 'StoreController@deliverPost')->name('deliverPost');