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

//======================================================================

// store
Route::get('/addstore', 'StoreController@addstore')->name('addstore');
Route::post('/storePost', 'StoreController@storePost')->name('storePost');
Route::get('/storeinfo',  ['middleware' => 'auth', 'uses' => "StoreController@index"]);
//// add dish
Route::post('/dishPost_add', 'StoreController@dishPost_add')->name('dishPost_add');
Route::get('/dish_add', ['middleware' => 'auth', 'uses' => 'StoreController@dish_add'])-> name('dish_add');
//// update dish
Route::post('/dishPost_update', 'StoreController@dishPost_update')->name('dishPost_update');
Route::get('/dish_update', ['middleware' => 'auth', 'uses' => 'StoreController@dish_update'])-> name('dish_update');
//// delete dish
Route::post('/dishPost_delete', 'StoreController@dishPost_delete')->name('dishPost_delete');
Route::get('/dish_delete', ['middleware' => 'auth', 'uses' => 'StoreController@dish_delete'])-> name('dish_delete');
//// order menu
Route::get('/menu/{storeid}',  ['middleware' => 'auth', 'uses' => "StoreController@menu"]);
Route::post('/orderPost_add', 'OrderController@orderPost_add')->name('orderPost_add');
//// Mydish
Route::get('/myDish',  ['middleware' => 'auth', 'uses' => "StoreController@myDish"])->name('myDish');;
//======================================================================

// deliver
Route::get('/adddeliver', 'DeliverController@add_deliver')->name('adddeliver');
Route::post('/deliverPost', 'DeliverController@deliverPost')->name('deliverPost');


//======================================================================


// customer
Route::get('/addcustomer', 'CustomerController@add_customer')->name('addcustomer');
Route::post('/customerPost', 'CustomerController@customerPost')->name('customerPost');


//======================================================================

//order
Route::get('/orderList_Deliver', 'OrderController@orderList_Deliver')->name('orderList_Deliver');