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

Route::get('/fill', ['uses' => 'BinaryController@fill', 'as' => 'binary.fill']);

Route::get('/reset', ['uses' => 'BinaryController@reset', 'as' => 'binary.reset']);

Route::post('/get-items', ['uses' => 'BinaryController@getItems', 'as' => 'binary.get_items']);
