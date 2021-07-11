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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('password',  function () {
//     return bcrypt('lia');
// });

Route::get('buku', 'API\BukuController@index');
Route::get('buku/{id}', 'API\BukuController@show');
Route::post('buku', 'API\BukuController@store')->middleware('auth:api');
Route::delete('buku/{id}', 'API\BukuController@destroy')->middleware('auth:api');
Route::patch('buku/{id}', 'API\BukuController@update')->middleware('auth:api');

Route::get('rakbuku', 'API\RakBukuController@index')->middleware('auth:api');
Route::get('rakbuku/{id}', 'API\RakBukuController@show')->middleware('auth:api');
Route::post('rakbuku', 'API\RakBukuController@store')->middleware('auth:api');
Route::delete('rakbuku/{id}', 'API\RakBukuController@destroy')->middleware('auth:api');
Route::patch('rakbuku/{id}', 'API\RakBukuController@update')->middleware('auth:api');


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('keluar', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('wajib', 'AuthController@wajiblogin');
    Route::post('daftar', 'AuthController@daftar');
});
