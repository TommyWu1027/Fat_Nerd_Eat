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
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//======================================================================

// store
// store information
Route::get('/storeHome', 'StoreController@storeHome')->name('storeHome');
Route::post('/storeInfoPost', 'StoreController@storeInfoPost')->name('storeInfoPost');

Route::get('/addstore', 'StoreController@addstore')->name('addstore');
Route::post('/storePost', 'StoreController@storePost')->name('storePost');
//// add dish
Route::post('/dishPost_add', 'StoreController@dishPost_add')->name('dishPost_add');
Route::get('/dish_add', ['middleware' => 'auth', 'uses' => 'StoreController@dish_add'])-> name('dish_add');
//// update dish
Route::post('/dishPost_update', 'StoreController@dishPost_update')->name('dishPost_update');
Route::get('/dish_update/{dishName}', ['middleware' => 'auth', 'uses' => 'StoreController@dish_update'])-> name('dish_update');
//// delete dish
Route::post('/dishPost_delete', 'StoreController@dishPost_delete')->name('dishPost_delete');
Route::get('/dish_delete', ['middleware' => 'auth', 'uses' => 'StoreController@dish_delete'])-> name('dish_delete');
//// order menu
Route::get('/storeinfo',  ['middleware' => 'auth', 'uses' => "StoreController@index"])-> name('storeinfo');
Route::post('/storeinfoSearch',  ['middleware' => 'auth', 'uses' => "StoreController@storeinfoSearch"])-> name('storeinfoSearch');
Route::get('/menu/{storeid}',  ['middleware' => 'auth', 'uses' => "StoreController@menu"])->name('menu');
//// Mydish
Route::get('/myDish',  ['middleware' => 'auth', 'uses' => "StoreController@myDish"])->name('myDish');;

//======================================================================

// deliver
Route::get('/adddeliver', 'DeliverController@add_deliver')->name('adddeliver');
Route::post('/deliverPost', 'DeliverController@deliverPost')->name('deliverPost');
Route::post('/orderReceive', 'DeliverController@orderReceive')->name('orderReceive');

//======================================================================


// customer
Route::get('/addcustomer', 'CustomerController@add_customer')->name('addcustomer');
Route::post('/customerPost', 'CustomerController@customerPost')->name('customerPost');
Route::post('/orderDelete', 'OrderController@orderDelete')->name('orderDelete');
Route::get('/orderUpdateGet/{orderid}', 'OrderController@orderUpdateGet')->name('orderUpdateGet');
Route::post('/orderUpdatePost', 'OrderController@orderUpdatePost')->name('orderUpdatePost');

//======================================================================

//order
Route::post('/orderPost_add', 'OrderController@orderPost_add')->name('orderPost_add');
Route::get('/orderList_Deliver', 'OrderController@orderList_Deliver')->name('orderList_Deliver');
Route::get('/orderList_Store', 'OrderController@orderList_Store')->name('orderList_Store');
Route::get('/orderDetail/{orderid}', ['middleware' => 'auth', 'uses' => 'OrderController@orderDetail'])->name('orderDetail');
Route::post('/changeStatus', 'OrderController@changeStatus')->name('changeStatus');

//StoreOrder
Route::get('/myOrderList', ['middleware' => 'auth', 'uses' => "OrderController@myOrderList"])->name('myOrderList');
