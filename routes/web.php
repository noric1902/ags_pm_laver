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

Route::get('{any}', 'Front\HomeController@index');

Auth::routes();
Route::group(['prefix' => 'auth'], function() {
    Route::post('/login', 'AuthController@login');
    Route::group(['middleware' => 'jwt.auth'], function(){ Route::get('/user', 'AuthController@user'); });
    Route::group(['middleware' => 'jwt.refresh'], function(){ Route::get('/refresh', 'AuthController@refresh'); });
});

$routeApp = array(
    '/', 
    '/login', 
    '/register',
);

foreach($routeApp as $route) {
    Route::get($route, 'Front\HomeController@index');
}