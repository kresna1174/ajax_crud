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

Route::group(['prefix' => 'barang'], function(){
    Route::get('/', 'App\Http\Controllers\BarangController@index')->name('barang');
    Route::get('/get', 'App\Http\Controllers\BarangController@get')->name('barang.get');
    Route::get('/create', 'App\Http\Controllers\BarangController@create')->name('barang.create');
    Route::get('/edit/{id?}', 'App\Http\Controllers\BarangController@edit')->name('barang.edit');
    Route::post('/update/{id?}', 'App\Http\Controllers\BarangController@update')->name('barang.update');
    Route::post('/store', 'App\Http\Controllers\BarangController@store')->name('barang.store');
    Route::get('/delete/{id?}', 'App\Http\Controllers\BarangController@delete')->name('barang.delete');
    Route::get('/view/{id?}', 'App\Http\Controllers\BarangController@view')->name('barang.view');
});
