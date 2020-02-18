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

Route::resource('binaries', 'BinaryController')->names([
    'index' => 'binary.index',
    'store' => 'binary.store'
]);

Route::get('/', ['uses' => 'BinaryController@index']);
