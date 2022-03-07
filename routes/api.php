<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/customers','customersController@show');
Route::post('/','customersController@store');
Route::put('/customers/{id}', 'customersController@update');
Route::delete('/customers/{id}', 'customersController@destroy');

Route::get('/petugas','petugasController@show');
Route::post('/petugas','petugasController@store');
Route::put('/petugas/{id}', 'petugasController@update');
Route::delete('/petugas/{id}', 'petugasController@destroy');

Route::get('/produk','produkController@show');
Route::post('/produk','produkController@store');
Route::put('/produk/{id}', 'produkController@update');
Route::delete('/produk/{id}', 'produkController@destroy');

Route::get('/transaksi', 'transaksiController@show');
Route::get('/transaksi/{id}', 'transaksiController@detail');
Route::post('/transaksi','transaksiController@store');
Route::put('/transaksi/{id}', 'transaksiController@update');
Route::delete('/transaksi/{id}', 'transaksiController@destroy');

Route::get('/detail_transaksi','detail_transaksiController@show');
Route::get('/detail_transaksi/{id}','detail_transaksiController@detail');
Route::post('/detail_transaksi','detail_transaksiController@store');
Route::put('/detail_transaksi/{id}','detail_transaksiController@update');
Route::delete('/detail_transaksi/{id}', 'detail_transaksiController@destroy');

