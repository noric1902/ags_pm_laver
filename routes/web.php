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

Auth::routes();

// Route::any('/{all}', function() {return view('front/app');})->where(['all' => '.*']);

// FrontEnd Controller
Route::get('/', 'Front\HomeController@index')->name('home');