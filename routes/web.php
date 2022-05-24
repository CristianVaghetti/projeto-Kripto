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

Route::get('get-all', 'App\Http\Controllers\KriptosController@getKriptos');
Route::get('get-price/{symbol}', 'App\Http\Controllers\KriptosController@getPrice');
Route::get('print-one/{symbol?}', 'App\Http\Controllers\KriptosController@getOne');

