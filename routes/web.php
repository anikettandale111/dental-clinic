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
Route::any('/create', 'HomeController@create')->name('create');
Route::any('/add_store', 'HomeController@add_store')->name('add_store');
Route::any('/edit_details/{id?}', 'HomeController@edit_details')->name('edit_details');
Route::any('/edit_register/{id?}', 'HomeController@edit_register')->name('edit_register');
Route::any('/store-eq', 'StoreController@index')->name('store_view');
Route::any('/add_stock', 'StoreController@add_stock')->name('add_stock');
Route::any('/stock_register', 'StoreController@stock_register')->name('stock_register');
Route::any('/edit_stock/{id?}', 'StoreController@edit_stock')->name('edit_stock');
Route::any('/update_stock', 'StoreController@update_stock')->name('update_stock');
Route::any('/dispatch', 'DispatchController@index')->name('dispatch');
Route::any('/add_dispatch', 'DispatchController@add_dispatch')->name('add_dispatch');
Route::post('/insert_dispatch', 'DispatchController@insert_dispatch')->name('insert_dispatch');
Route::any('/get_bar_code_data', 'DispatchController@get_bar_code_data')->name('get_bar_code_data');
Route::any('/qrgenerator', 'StoreController@qr_generator')->name('qrgenerator');
Route::any('/clinic', 'ClinicLocationController@index')->name('clinic');
Route::any('/add_clinic', 'ClinicLocationController@add_clinic')->name('add_clinic');
Route::any('/add_location', 'ClinicLocationController@add_location')->name('add_location');
Route::any('/edit_location/{id?}', 'ClinicLocationController@edit_location')->name('edit_location');
Route::any('/update_location', 'ClinicLocationController@update_location')->name('update_location');
Route::any('/category', 'CategoryController@index')->name('category');
Route::any('/add_category', 'CategoryController@add_category')->name('add_category');
Route::any('/insert_category', 'CategoryController@insert_category')->name('insert_category');
Route::any('/update_category', 'CategoryController@update_category')->name('update_category');
Route::any('/edit_category/{id?}', 'CategoryController@edit_category')->name('edit_category');
Route::any('/manufacturer', 'ManufacturerController@index')->name('manufacturer');
Route::any('/add_manufacturer', 'ManufacturerController@add_manufacturer')->name('add_manufacturer');
Route::any('/insert_manufacturer', 'ManufacturerController@set_manufacturer')->name('insert_manufacturer');
Route::any('/update_category', 'ManufacturerController@update_category')->name('update_category');
Route::any('/edit_category/{id?}', 'ManufacturerController@edit_category')->name('edit_category');
Route::any('/product', 'ProductController@index')->name('product');
Route::any('/add_manufacturer', 'ProductController@add_manufacturer')->name('add_manufacturer');
Route::any('/insert_manufacturer', 'ProductController@set_manufacturer')->name('insert_manufacturer');
Route::any('/update_category', 'ProductController@update_category')->name('update_category');
Route::any('/edit_category/{id?}', 'ProductController@edit_category')->name('edit_category');
Route::any('/unit', 'UnitController@index')->name('unit');
Route::any('/add_unit', 'UnitController@add_unit')->name('add_unit');
Route::any('/insert_unit', 'UnitController@set_unit')->name('insert_unit');
Route::any('/update_unit', 'UnitController@update_unit')->name('update_unit');
Route::any('/edit_unit/{id?}', 'UnitController@edit_unit')->name('edit_unit');