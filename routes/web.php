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

Route::get('customers', 'App\Http\Controllers\orderingController@getcustomers')->name('customers');
Route::get('orders', 'App\Http\Controllers\orderingController@getorders')->name('orders');
Route::get('vieworder/{id}', 'App\Http\Controllers\orderingController@vieworder')->name('vieworder');
Route::get('products', 'App\Http\Controllers\orderingController@products')->name('products');
Route::get('/', 'App\Http\Controllers\orderingController@dashboard')->name('dashboard');
Route::post('/filter', 'App\Http\Controllers\orderingController@filter')->name('filter');
