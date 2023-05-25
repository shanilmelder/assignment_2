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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/signup', function () {
    return view('register');
});

Route::get('/signin', function () {
    return view('login');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/trading-master', 'TradingController@index')->name('trading-master');

Route::post('/trading-master-save', 'TradingController@save')->name('trading-master-save');

Route::post('/trading-master-delete', 'TradingController@delete')->name('trading-master-delete');

Route::get('/trading', 'TradingController@trading')->name('trading');

Route::post('/trading-sell', 'TradingController@sell')->name('trading-sell');

Route::post('/trading-buy', 'TradingController@buy')->name('trading-buy');

Route::get('/user-list', 'UsersController@userList')->name('user-list');

Route::get('/user-edit/{id}', 'UsersController@edit')->name('user-edit');

Route::post('/user-update', 'UsersController@update')->name('user-update');

Route::get('/trading-history', 'TradingController@viewTadeHistory')->name('trading-history');
