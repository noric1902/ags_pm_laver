<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['prefix' => 'v1'], function() {
    Route::apiResource('jenis', 'API\JenisController');
    Route::apiResource('kategori', 'API\KategoriController');
    Route::apiResource('site', 'API\SiteController');
    Route::apiResource('pekerjaan', 'API\PekerjaanController');
    Route::apiResource('project', 'API\ProjectController');
    Route::apiResource('pengajuan', 'API\PengajuanController');
});