<?php

use Illuminate\Support\Facades\Route;

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
    return view('index');
});

Auth::routes();

//Home
Route::get('/home', 'HomeController@index')->name('home');

//Auth
Route::get('logout', 'Auth\LoginController@logout');


//Items
Route::get('add item', 'Others\ItemController@index');
Route::post('add item', 'Others\ItemController@store');
Route::get('item/{id}/delete', 'Others\ItemController@destroy');
Route::post('add item', 'Others\ItemController@store');
Route::get('compute/{given_price}/{given_quantity}/item', 'Others\ItemController@computing');


//Orders
Route::get('orders', 'Others\OrderController@index');

//Table
Route::get('save table items', 'ItemController@saveTableItems');

