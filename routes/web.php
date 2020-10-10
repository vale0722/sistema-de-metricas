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
    return view('welcome');
});

Route::get('sellers', 'SellerController@index')->name('sellers.index');
Route::get('invoices', 'InvoiceController@index')->name('invoices.index');
Route::get('metrics', 'MetricController@index')->name('metrics.index');
Route::get('metrics/{metric}', 'MetricController@show')->name('metrics.show');
