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

Route::get('/', 'WatchController@index');

Route::resource('watches', 'WatchController');

Route::post('watches/filter', 'WatchController@filter')->name('watches.filter');

Route::get('watch/{url_slug}', 'WatchController@urlslug')->name('watch.urlslug');