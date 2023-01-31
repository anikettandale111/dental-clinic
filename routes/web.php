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
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::any('/clinic_details', 'HomeController@clinic_details')->name('clinic_details');
Route::any('/add_store', 'HomeController@add_store')->name('add_store');
Route::any('/edit_details/{id?}', 'HomeController@edit_details')->name('edit_details');
Route::any('/edit_register/{id?}', 'HomeController@edit_register')->name('edit_register');
Route::any('/store-eq', 'StoreController@index')->name('store_view');
Route::any('/add_stock', 'StoreController@add_stock')->name('add_stock');
Route::any('/stock_register', 'StoreController@stock_register')->name('stock_register');
Route::any('/edit_stock/{id?}', 'StoreController@edit_stock')->name('edit_stock');
Route::any('/update_stock', 'StoreController@update_stock')->name('update_stock');
Route::any('/dispatch', 'DispatchController@index')->name('dispatch');